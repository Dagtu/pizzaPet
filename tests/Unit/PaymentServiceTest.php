<?php

namespace Tests\Unit;


use App\Modules\Payment\Application\Contracts\BankGatewayInterface;
use App\Modules\Payment\Application\Exceptions\BankGatewayException;
use App\Modules\Payment\Application\Exceptions\PaymentRepositoryException;
use App\Modules\Payment\Application\Exceptions\PaymentServiceException;
use App\Modules\Payment\Application\Repositories\PaymentRepositoryInterface;
use App\Modules\Payment\Application\Services\PaymentService;
use App\Modules\Payment\Domain\Entities\PaymentEntity;
use App\Modules\Payment\Domain\Enums\BankStatuses;
use App\Modules\Payment\Domain\Enums\PaymentStatuses;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class PaymentServiceTest extends TestCase
{
    protected PaymentService $paymentService;
    protected PaymentRepositoryInterface $paymentRepositoryMock;
    protected BankGatewayInterface $bankGatewayMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->bankGatewayMock = $this->createMock(BankGatewayInterface::class);
        $this->paymentRepositoryMock = $this->createMock(PaymentRepositoryInterface::class);
        $this->paymentService = new PaymentService($this->paymentRepositoryMock, $this->bankGatewayMock);
    }

    /**
     * @throws PaymentServiceException
     * @throws Exception
     */
    public function test_process_payment_when_type_is_card_and_result_bank_status_is_success_and_update_status_is_success()
    {
        $fakePaymentEntity = new PaymentEntity(
            id: 1,
            time: time(),
            status: PaymentStatuses::Pending->value,
            type: 'card',
            orderId: 1,
        );

        $this->paymentRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with(1, 'card', PaymentStatuses::Pending->value)
            ->willReturn($fakePaymentEntity);

        $this->bankGatewayMock
            ->expects($this->once())
            ->method('send')
            ->willReturn(BankStatuses::Success->value);

        $this->paymentRepositoryMock
            ->expects($this->once())
            ->method('updateStatus')
            ->with(1, PaymentStatuses::Success->value)
            ->willReturn(true);

        $result =$this->paymentService->processPayment(1, 'card');

        $this->assertInstanceOf(PaymentEntity::class, $result);
        $this->assertEquals(1, $result->id);
        $this->assertEquals(PaymentStatuses::Success->value, $result->status);
    }

    /**
     * @throws PaymentServiceException
     */
    public function test_process_payment_when_type_is_card_and_result_bank_status_is_failed()
    {
        $fakePaymentEntity = new PaymentEntity(
            id: 1,
            time: time(),
            status: PaymentStatuses::Pending->value,
            type: 'card',
            orderId: 1,
        );

        $this->paymentRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with(1, 'card', PaymentStatuses::Pending->value)
            ->willReturn($fakePaymentEntity);

        $this->bankGatewayMock
            ->expects($this->once())
            ->method('send')
            ->willThrowException(new BankGatewayException(BankGatewayException::CODE_BANK_GATEWAY_ERROR));

        $this->paymentRepositoryMock
            ->expects($this->once())
            ->method('updateStatus')
            ->with(1, PaymentStatuses::Failed->value)
            ->willReturn(true);

        $this->expectException(PaymentServiceException::class);
        $this->expectExceptionCode(402);
        $this->expectExceptionMessage('Payment failed');

        $this->paymentService->processPayment(1, 'card');
    }

    /**
     * @throws PaymentServiceException
     */
    public function test_process_payment_when_type_is_card_and_result_bank_status_is_success_and_update_status_is_error()
    {
        $fakePaymentEntity = new PaymentEntity(
            id: 1,
            time: time(),
            status: PaymentStatuses::Pending->value,
            type: 'card',
            orderId: 1,
        );

        $this->paymentRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with(1, 'card', PaymentStatuses::Pending->value)
            ->willReturn($fakePaymentEntity);

        $this->bankGatewayMock
            ->expects($this->once())
            ->method('send')
            ->willReturn(BankStatuses::Success->value);

        $this->paymentRepositoryMock
            ->expects($this->once())
            ->method('updateStatus')
            ->with(1, PaymentStatuses::Success->value)
            ->willThrowException(new PaymentRepositoryException(PaymentRepositoryException::CODE_ERROR_UPDATE_STATUS));

        $this->expectException(PaymentRepositoryException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Error update status');

        $this->paymentService->processPayment(1, 'card');
    }

    /**
     * @throws PaymentServiceException
     */
    public function test_process_payment_when_type_is_cash()
    {
        $fakePaymentEntity = new PaymentEntity(
            id: 1,
            time: time(),
            status: PaymentStatuses::Pending->value,
            type: 'cash',
            orderId: 1,
        );

        $this->paymentRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with(1, 'cash', PaymentStatuses::Pending->value)
            ->willReturn($fakePaymentEntity);

        $result = $this->paymentService->processPayment(1, 'cash');

        $this->assertInstanceOf(PaymentEntity::class, $result);
        $this->assertEquals(1, $result->id);
        $this->assertEquals(PaymentStatuses::Pending->value, $result->status);
    }
}

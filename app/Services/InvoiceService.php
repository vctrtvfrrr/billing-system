<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    protected string $id;
    protected string $amount;
    protected string $dueDate;
    protected string $barcode;
    protected string $customerName;
    protected string $customerDocument;
    protected string $customerEmail;

    public function handle(Invoice $invoice): Invoice
    {
        $this->setId($invoice->debt_id);
        $this->setAmount($invoice->debt_amount);
        $this->setDueDate($invoice->debt_due_date);
        $this->setCustomerName($invoice->customer->name);
        $this->setcustomerDocument($invoice->customer->government_id);
        $this->setCustomerEmail($invoice->customer->email);

        $invoice->filename = $this->generateInvoiceFile();

        return $invoice;
    }

    protected function setId(int $id): void
    {
        $this->id = '<h1><strong>Fatura nº #'.$id.'</strong></h1>';
    }

    protected function setAmount(float $amount): void
    {
        $barcode = fake()->randomNumber(5).'.'
            .fake()->randomNumber(5).' '
            .fake()->randomNumber(5).'.'
            .fake()->randomNumber(6).' '
            .fake()->randomNumber(5).'.'
            .fake()->randomNumber(6).' 1 '
            .fake()->randomNumber(4).
            str_pad(number_format($amount, 2, '', ''), 10, '0', STR_PAD_LEFT);

        $this->barcode = '<strong>'.$barcode.'</strong>';
        $this->amount = '<strong>R$ '.number_format($amount, 2, ',', '.').'</strong>';
    }

    protected function setDueDate(Carbon $date): void
    {
        $this->dueDate = 'Vencimento: '.$date->format('d/m/Y');
    }

    protected function setCustomerName(string $name): void
    {
        $this->customerName = '<h2><strong>'.$name.'</strong></h2>';
    }

    protected function setcustomerDocument(string $document): void
    {
        $this->customerDocument = '<em>'.$document.'<em>';
    }

    protected function setCustomerEmail(string $email): void
    {
        $this->customerEmail = '<a href="mailto:'.$email.'">'.$email.'<a>';
    }

    protected function generateInvoiceFile(): string
    {
        $html = '<div>'.implode('</div><div>', [
            $this->id,
            $this->customerName,
            $this->customerEmail,
            $this->customerDocument,
            $this->dueDate,
            $this->amount,
            $this->barcode,
        ]).'</div>';

        $pdf = Pdf::loadHTML($html);

        $filename = 'invoices/invoice-'.md5($this->id).'.pdf';

        Storage::put($filename, $pdf->output());

        return $filename;
    }
}

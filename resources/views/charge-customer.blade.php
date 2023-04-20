<h1><strong>Fatura nº #{{ $invoice->debt_id }}</strong></h1>
<h2><strong>{{ $invoice->customer->name }}</strong> <small><em>CPF: {{ $invoice->customer->government_id }}<em></em></small></h2>
<div>Vencimento: {{ $invoice->debt_due_date->format('d/m/Y') }}</div>
<div><strong>R$ {{ number_format($invoice->debt_amount, 2, '.', ',') }}</strong></div>

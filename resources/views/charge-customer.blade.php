<h1><strong>Fatura nº #{{ $charge->debt_id }}</strong></h1>
<h2><strong>{{ $charge->name }}</strong> <small><em>CPF: {{ $charge->government_id }}<em></em></small></h2>
<div>Vencimento: {{ $charge->debt_due_date->format('d/m/Y') }}</div>
<div><strong>R$ {{ number_format($charge->debt_amount, 2, '.', ',') }}</strong></div>

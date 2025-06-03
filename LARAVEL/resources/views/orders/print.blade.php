<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan #{{ $order->order_code }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            width: 80mm;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mb-1 { margin-bottom: 5px; }
        .mb-2 { margin-bottom: 10px; }
        .mb-3 { margin-bottom: 15px; }
        .border-bottom { border-bottom: 1px dashed #000; }
        .w-100 { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 3px 0; }
        .font-bold { font-weight: bold; }
        @media print {
            @page { margin: 0; }
            body { margin: 10px; }
        }
    </style>
</head>
<body>
    <div class="text-center mb-3">
        <h2 style="margin: 0;">{{ config('app.name') }}</h2>
        <p class="mb-1">Struk Pesanan</p>
        <p class="mb-2">#{{ $order->order_code }}</p>
    </div>

    <div class="mb-3 border-bottom">
        <table>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>:</td>
                <td>{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>{{ $order->status_label }}</td>
            </tr>
        </table>
    </div>

    <div class="mb-3 border-bottom">
        <table>
            <thead>
                <tr>
                    <th class="text-left">Item</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right font-bold">Total</td>
                    <td class="text-right font-bold">{{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if($order->notes)
    <div class="mb-3 border-bottom">
        <p class="mb-1">Catatan:</p>
        <p>{{ $order->notes }}</p>
    </div>
    @endif

    <div class="text-center">
        <p class="mb-1">Terima kasih atas kunjungan Anda</p>
        <p>Silakan datang kembali</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 500);
        };
    </script>
</body>
</html>
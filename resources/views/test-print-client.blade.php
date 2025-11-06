<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Test Print Client</title>
    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 0;
                font-family: 'Courier New', monospace;
                font-size: 12px;
            }
        }
    </style>
</head>

<body onload="window.print(); setTimeout(() => window.close(), 1000);">

    <pre style="text-align:center;">
  🧾 TES CETAK SUKSES!
  ----------------------------
  Waktu: {{ now()->format('d-m-Y H:i:s') }}
  Printer: POS-58
  ----------------------------
  Terima kasih 😊
  </pre>

</body>

</html>

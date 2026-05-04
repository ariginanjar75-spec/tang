<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Utang Baru - Debt Tracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --bg: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --text: #f8fafc;
            --text-dim: #94a3b8;
            --accent: #22d3ee;
            --danger: #f43f5e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: var(--bg);
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(34, 211, 238, 0.1) 0px, transparent 50%);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            max-width: 600px;
            width: 100%;
        }

        header {
            text-align: center;
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(to right, #818cf8, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dim);
            font-weight: 500;
            font-size: 0.9rem;
        }

        input, select {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 0.85rem 1.25rem;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.2);
        }

        .installment-preview {
            margin-top: 1.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .preview-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.25rem;
            border-radius: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .preview-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .preview-item.active {
            background: rgba(79, 70, 229, 0.2);
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.3);
        }

        .preview-label {
            font-size: 0.8rem;
            color: var(--text-dim);
            margin-bottom: 0.25rem;
        }

        .preview-value {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--accent);
        }

        .btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .btn:hover {
            background: var(--primary-light);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-dim);
            margin-top: 1rem;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--text-dim);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--accent);
        }

        .back-link svg {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('debts.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Kembali ke Daftar
        </a>

        <header>
            <h1>Tambah Utang Baru</h1>
            <p style="color: var(--text-dim);">Catat hutang baru dan hitung estimasi cicilan Anda.</p>
        </header>

        <div class="card">
            <form action="{{ route('debts.store') }}" method="POST" id="debtForm">
                @csrf
                <div class="form-group">
                    <label for="description">Keterangan Hutang</label>
                    <input type="text" name="description" id="description" placeholder="Contoh: Pinjaman Bank, Hutang Motor" required autofocus>
                </div>

                <div class="form-group">
                    <label for="total_amount">Total Hutang</label>
                    <input type="text" name="total_amount" id="total_amount" data-type="currency" placeholder="0" required>
                </div>

                <label>Pilih Tenor (Jangka Waktu)</label>
                <div class="installment-preview" id="previewGrid">
                    <div class="preview-item" data-tenor="3" onclick="selectTenor(3)">
                        <div class="preview-label">3 Bulan</div>
                        <div class="preview-value" id="val-3">Rp 0</div>
                    </div>
                    <div class="preview-item" data-tenor="6" onclick="selectTenor(6)">
                        <div class="preview-label">6 Bulan</div>
                        <div class="preview-value" id="val-6">Rp 0</div>
                    </div>
                    <div class="preview-item" data-tenor="8" onclick="selectTenor(8)">
                        <div class="preview-label">8 Bulan</div>
                        <div class="preview-value" id="val-8">Rp 0</div>
                    </div>
                    <div class="preview-item" data-tenor="12" onclick="selectTenor(12)">
                        <div class="preview-label">12 Bulan</div>
                        <div class="preview-value" id="val-12">Rp 0</div>
                    </div>
                </div>

                <input type="hidden" name="selected_tenor" id="selected_tenor" required>
                <input type="hidden" name="monthly_installment" id="monthly_installment" required>

                <button type="submit" class="btn" id="submitBtn" disabled>Simpan Hutang</button>
            </form>
        </div>
    </div>

    <script>
        const amountInput = document.getElementById('total_amount');
        const tenors = [3, 6, 8, 12];
        const previewItems = document.querySelectorAll('.preview-item');
        const selectedTenorInput = document.getElementById('selected_tenor');
        const monthlyInstallmentInput = document.getElementById('monthly_installment');
        const submitBtn = document.getElementById('submitBtn');

        function formatNumber(val) {
            if (!val) return "";
            return val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        amountInput.addEventListener('input', function(e) {
            let cursorPosition = this.selectionStart;
            let valueBefore = this.value;
            let formattedValue = formatNumber(this.value);
            this.value = formattedValue;
            
            let diff = formattedValue.length - valueBefore.length;
            this.setSelectionRange(cursorPosition + diff, cursorPosition + diff);

            updatePreviews();
        });

        function updatePreviews() {
            const rawValue = amountInput.value.replace(/,/g, "");
            const amount = parseFloat(rawValue) || 0;
            
            tenors.forEach(t => {
                const installment = amount / t;
                const display = installment.toLocaleString('id-ID', { 
                    style: 'currency', 
                    currency: 'IDR',
                    maximumFractionDigits: 0 
                });
                document.getElementById(`val-${t}`).innerText = display;
            });

            if (selectedTenorInput.value) {
                const currentTenor = parseInt(selectedTenorInput.value);
                monthlyInstallmentInput.value = (amount / currentTenor).toFixed(2);
            }
        }

        function selectTenor(t) {
            const rawValue = amountInput.value.replace(/,/g, "");
            const amount = parseFloat(rawValue) || 0;
            if (amount <= 0) return;

            previewItems.forEach(item => {
                item.classList.remove('active');
                if (parseInt(item.dataset.tenor) === t) {
                    item.classList.add('active');
                }
            });

            selectedTenorInput.value = t;
            monthlyInstallmentInput.value = (amount / t).toFixed(2);
            submitBtn.disabled = false;
        }

        document.getElementById('debtForm').addEventListener('submit', function() {
            // Remove anything that is not a digit
            amountInput.value = amountInput.value.replace(/\D/g, "");
        });
    </script>
</body>
</html>

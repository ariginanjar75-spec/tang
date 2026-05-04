<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Tracker - Premium Installment Calculator</title>
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
            padding: 2rem;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 3rem;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #818cf8, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        p.subtitle {
            color: var(--text-dim);
            font-size: 1.1rem;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2rem;
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
            padding: 0.75rem 1rem;
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
            padding: 1rem;
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
        }

        .preview-label {
            font-size: 0.8rem;
            color: var(--text-dim);
            margin-bottom: 0.25rem;
        }

        .preview-value {
            font-weight: 700;
            font-size: 1.1rem;
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
            margin-top: 1rem;
        }

        .btn:hover {
            background: var(--primary-light);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }

        .debt-list {
            margin-top: 3rem;
        }

        .debt-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--card-bg);
            padding: 1.25rem 1.5rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.3s ease;
        }

        .debt-item:hover {
            transform: scale(1.01);
        }

        .debt-info h3 {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .debt-info p {
            color: var(--text-dim);
            font-size: 0.85rem;
        }

        .debt-amount {
            text-align: right;
        }

        .amount-total {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text);
        }

        .amount-monthly {
            font-size: 0.9rem;
            color: var(--accent);
        }

        .delete-btn {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            margin-left: 1.5rem;
            opacity: 0.6;
            transition: opacity 0.3s;
        }

        .delete-btn:hover {
            opacity: 1;
        }

        .edit-btn {
            background: none;
            border: none;
            color: var(--primary-light);
            cursor: pointer;
            margin-left: 1rem;
            opacity: 0.6;
            transition: opacity 0.3s;
        }

        .edit-btn:hover {
            opacity: 1;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-dim);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Debt Tracker</h1>
            <p class="subtitle">Calculated according to your needs</p>
        </header>

        @if(session('success'))
            <div style="background: rgba(34, 211, 238, 0.2); border: 1px solid var(--accent); color: var(--accent); padding: 1rem; border-radius: 0.75rem; margin-bottom: 2rem; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: rgba(244, 63, 94, 0.2); border: 1px solid var(--danger); color: var(--danger); padding: 1rem; border-radius: 0.75rem; margin-bottom: 2rem;">
                <ul style="list-style: none;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid">
            <div class="card">
                <form action="{{ route('debts.store') }}" method="POST" id="debtForm">
                    @csrf
                    <div class="form-group">
                        <label for="description">Keterangan Hutang</label>
                        <input type="text" name="description" id="description" placeholder="e.g. Pinjaman Bank" required>
                    </div>

                    <div class="form-group">
                        <label for="total_amount">Total Hutang</label>
                        <input type="text" name="total_amount" id="total_amount" data-type="currency" placeholder="0" required>
                    </div>

                    <label>Pilih Tenor (Yang harus dibayar)</label>
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

            <div class="debt-summary">
                <div class="card" style="height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                    <div style="font-size: 3rem; color: var(--accent); margin-bottom: 1rem;">📊</div>
                    <h2 style="margin-bottom: 1rem;">Live Preview</h2>
                    <p style="color: var(--text-dim);">Input your debt amount to see monthly repayment options across different tenors.</p>
                </div>
            </div>
        </div>

        <div class="debt-list">
            <h2 style="margin-bottom: 1.5rem;">Daftar Hutang</h2>
            @forelse($debts as $debt)
                <div class="debt-item" style="flex-direction: column; align-items: stretch;">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;" id="debt-info-{{ $debt->id }}">
                        <div class="debt-info">
                            <h3>{{ $debt->description }}</h3>
                            <p>Tenor Utama: {{ $debt->selected_tenor }} Bulan • Dibuat pada {{ $debt->created_at->format('d M Y') }}</p>
                            
                            <div style="margin-top: 0.75rem; display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; color: var(--text-dim); background: rgba(255,255,255,0.04); padding: 0.6rem 0.8rem; border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.08);">
                                <span style="font-weight: 600; color: #fff; margin-right: 0.25rem;">Estimasi Sisa:</span>
                                @foreach([3, 6, 8, 12] as $t)
                                    <div style="display: flex; flex-direction: column; {{ $t == $debt->selected_tenor ? 'background: rgba(0, 243, 255, 0.1); padding: 0.2rem 0.5rem; border-radius: 0.4rem; border: 1px solid rgba(0, 243, 255, 0.2);' : '' }}">
                                        <span style="font-size: 0.65rem; text-transform: uppercase; opacity: 0.6;">{{ $t }} Bulan</span>
                                        <span style="{{ $t == $debt->selected_tenor ? 'color: var(--accent); font-weight: 800;' : 'color: #fff;' }}">
                                            {{ number_format($debt->remaining_balance / $t, 0) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="display: flex; align-items: center;" id="debt-actions-{{ $debt->id }}">
                            <div class="debt-amount">
                                <div class="amount-total">Rp {{ number_format($debt->total_amount, 2) }}</div>
                                <div class="amount-monthly">Rp {{ number_format($debt->monthly_installment, 2) }} / bln</div>
                            </div>
                            
                            <button type="button" class="edit-btn" onclick="toggleEditDebt({{ $debt->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </button>

                            <form action="{{ route('debts.destroy', $debt->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Hapus data ini?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Debt Form (Hidden by default) -->
                    <div id="edit-debt-container-{{ $debt->id }}" style="display: none; margin-bottom: 1rem; background: rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 1rem; border: 1px solid var(--primary-light);">
                        <form action="{{ route('debts.update', $debt->id) }}" method="POST" class="debt-edit-form">
                            @csrf
                            @method('PUT')
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div>
                                    <label style="font-size: 0.8rem; margin-bottom: 0.3rem;">Keterangan</label>
                                    <input type="text" name="description" value="{{ $debt->description }}" required>
                                </div>
                                <div>
                                    <label style="font-size: 0.8rem; margin-bottom: 0.3rem;">Total Hutang</label>
                                    <input type="text" name="total_amount" data-type="currency" value="{{ number_format($debt->total_amount, 0) }}" required>
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <button type="button" class="btn" style="width: auto; margin-top: 0; padding: 0.5rem 1.5rem; background: var(--text-dim);" onclick="toggleEditDebt({{ $debt->id }})">Batal</button>
                                <button type="submit" class="btn" style="width: auto; margin-top: 0; padding: 0.5rem 1.5rem;">Update Hutang</button>
                            </div>
                        </form>
                    </div>
                    
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <span style="font-size: 0.85rem; color: var(--text-dim);">Sisa Hutang:</span>
                            <span style="font-weight: 700; color: {{ $debt->remaining_balance > 0 ? 'var(--accent)' : '#10b981' }};">
                                Rp {{ number_format($debt->remaining_balance, 2) }}
                            </span>
                        </div>
                        
                        <div style="height: 6px; background: rgba(255,255,255,0.05); border-radius: 3px; overflow: hidden; margin-bottom: 1rem;">
                            @php
                                $progress = ($debt->total_amount - $debt->remaining_balance) / $debt->total_amount * 100;
                            @endphp
                            <div style="width: {{ $progress }}%; height: 100%; background: var(--accent); transition: width 0.5s ease;"></div>
                        </div>

                        @if($debt->repayments->count() > 0)
                        <div style="margin-top: 1rem; background: rgba(255,255,255,0.03); border-radius: 0.75rem; padding: 0.75rem;">
                            <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-dim); margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em;">Riwayat Bayar & Jadwal</div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <!-- History -->
                                <div>
                                    <div style="font-size: 0.65rem; color: var(--text-dim); margin-bottom: 0.3rem;">Riwayat Transaksi:</div>
                                    <table style="width: 100%; font-size: 0.75rem; border-collapse: collapse;">
                                        @foreach($debt->repayments->sortByDesc('payment_date') as $repayment)
                                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);" id="repayment-row-{{ $repayment->id }}">
                                            <td style="padding: 0.2rem 0; color: var(--text-dim);">{{ \Carbon\Carbon::parse($repayment->payment_date)->format('d/m/y') }}</td>
                                            <td style="padding: 0.2rem 0; text-align: right; color: #10b981;">
                                                <span onclick="toggleEditRepayment({{ $repayment->id }})" style="cursor: pointer;" title="Klik untuk edit">+{{ number_format($repayment->amount, 0) }}</span>
                                            </td>
                                            <td style="padding: 0.2rem 0; width: 20px; text-align: right;">
                                                <form action="{{ route('repayments.destroy', $repayment->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background: none; border: none; color: var(--danger); opacity: 0.5; cursor: pointer; padding: 0;" onclick="return confirm('Hapus riwayat ini?')">×</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Edit Form Inline -->
                                        <tr id="edit-repayment-{{ $repayment->id }}" style="display: none; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                            <td colspan="3" style="padding: 0.5rem 0;">
                                                <form action="{{ route('repayments.update', $repayment->id) }}" method="POST" class="repayment-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <div style="display: flex; gap: 0.3rem;">
                                                        <input type="text" name="amount" data-type="currency" value="{{ number_format($repayment->amount, 0) }}" style="padding: 0.2rem 0.4rem; font-size: 0.75rem; flex: 2;" required>
                                                        <input type="date" name="payment_date" value="{{ $repayment->payment_date }}" style="padding: 0.2rem 0.4rem; font-size: 0.75rem; flex: 2;" required>
                                                        <button type="submit" class="btn" style="width: auto; margin-top: 0; padding: 0.2rem 0.5rem; font-size: 0.7rem;">✓</button>
                                                        <button type="button" onclick="toggleEditRepayment({{ $repayment->id }})" class="btn" style="width: auto; margin-top: 0; padding: 0.2rem 0.5rem; font-size: 0.7rem; background: var(--text-dim);">×</button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                
                                <!-- Schedule -->
                                <div style="border-left: 1px solid rgba(255,255,255,0.05); padding-left: 0.5rem;">
                                    <div style="font-size: 0.65rem; color: var(--text-dim); margin-bottom: 0.3rem;">Status Tenor ({{ $debt->selected_tenor }} Bln):</div>
                                    <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
                                        @php
                                            $totalPaid = $debt->repayments->sum('amount');
                                            $monthly = $debt->monthly_installment;
                                        @endphp
                                        @for($i = 1; $i <= $debt->selected_tenor; $i++)
                                            @php
                                                $isLunas = $totalPaid >= ($i * $monthly);
                                                $isPartial = !$isLunas && $totalPaid > (($i - 1) * $monthly);
                                            @endphp
                                            <div title="Cicilan {{ $i }}: Rp {{ number_format($monthly, 0) }}" 
                                                 style="width: 24px; height: 24px; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; font-weight: 700; 
                                                        background: {{ $isLunas ? 'rgba(16, 185, 129, 0.2)' : ($isPartial ? 'rgba(245, 158, 11, 0.2)' : 'rgba(255,255,255,0.05)') }};
                                                        color: {{ $isLunas ? '#10b981' : ($isPartial ? '#f59e0b' : 'var(--text-dim)') }};
                                                        border: 1px solid {{ $isLunas ? '#10b981' : ($isPartial ? '#f59e0b' : 'transparent') }};">
                                                {{ $i }}
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($debt->remaining_balance > 0)
                        <form action="{{ route('repayments.store', $debt->id) }}" method="POST" class="repayment-form" style="display: flex; gap: 0.5rem; align-items: flex-end;">
                            @csrf
                            <div style="flex: 1;">
                                <label style="font-size: 0.7rem; margin-bottom: 0.2rem;">Jumlah Bayar</label>
                                <input type="text" name="amount" data-type="currency" placeholder="Rp" style="padding: 0.4rem 0.75rem; font-size: 0.9rem;" required>
                            </div>
                            <div style="flex: 1;">
                                <label style="font-size: 0.7rem; margin-bottom: 0.2rem;">Tanggal</label>
                                <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" style="padding: 0.4rem 0.75rem; font-size: 0.9rem;" required>
                            </div>
                            <button type="submit" class="btn" style="margin-top: 0; width: auto; padding: 0.4rem 1rem; font-size: 0.8rem;">Bayar</button>
                        </form>
                        @else
                        <div style="text-align: center; color: #10b981; font-size: 0.85rem; font-weight: 600; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); border-radius: 0.5rem;">
                            Lunas! 🎉
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="card empty-state">
                    <p>Belum ada data hutang.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        const amountInput = document.getElementById('total_amount');
        const tenors = [3, 6, 8, 12];
        const previewItems = document.querySelectorAll('.preview-item');
        const selectedTenorInput = document.getElementById('selected_tenor');
        const monthlyInstallmentInput = document.getElementById('monthly_installment');
        const submitBtn = document.getElementById('submitBtn');

        function toggleEditRepayment(id) {
            const row = document.getElementById(`repayment-row-${id}`);
            const editRow = document.getElementById(`edit-repayment-${id}`);
            if (editRow.style.display === 'none') {
                editRow.style.display = 'table-row';
                row.style.display = 'none';
            } else {
                editRow.style.display = 'none';
                row.style.display = 'table-row';
            }
        }

        function toggleEditDebt(id) {
            const infoRow = document.getElementById(`debt-info-${id}`);
            const editContainer = document.getElementById(`edit-debt-container-${id}`);
            
            if (editContainer.style.display === 'none') {
                editContainer.style.display = 'block';
                infoRow.style.display = 'none';
            } else {
                editContainer.style.display = 'none';
                infoRow.style.display = 'flex';
            }
        }

        // Helper to format number with commas
        function formatNumber(val) {
            if (!val) return "";
            return val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Apply formatting to inputs
        document.querySelectorAll('input[data-type="currency"]').forEach(input => {
            input.addEventListener('input', function(e) {
                let cursorPosition = this.selectionStart;
                let valueBefore = this.value;
                let formattedValue = formatNumber(this.value);
                this.value = formattedValue;
                
                // Adjust cursor position
                let diff = formattedValue.length - valueBefore.length;
                this.setSelectionRange(cursorPosition + diff, cursorPosition + diff);

                if (this.id === 'total_amount') {
                    updatePreviews();
                }
            });
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

        // Clean values before form submit
        document.getElementById('debtForm').addEventListener('submit', function() {
            amountInput.value = amountInput.value.replace(/,/g, "");
        });

        document.querySelectorAll('.repayment-form, .debt-edit-form').forEach(form => {
            form.addEventListener('submit', function() {
                const amountInput = this.querySelector('input[name="amount"], input[name="total_amount"]');
                if (amountInput) {
                    amountInput.value = amountInput.value.replace(/,/g, "");
                }
            });
        });
    </script>
</body>
</html>

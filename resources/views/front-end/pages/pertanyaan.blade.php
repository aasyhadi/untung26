@extends('front-end.layouts.app')
@section('title', 'Beranda - Layanan Konsultasi Konstruksi')

@section('content')
<div class="container" style="margin-bottom: 200px; text-align:center;">
    <div class="modal-content">
        <a href="/"><span class="close">&times;</span></a>
        <h2>Konsultasi Online</h2>
        <form id="consultationForm" action="{{ route('konsultasi.store') }}" method="POST" onsubmit="return validateForm()">
            @csrf
            <label for="whatsappNumber">No WhatsApp:</label>
            <input type="text" id="whatsappNumber" name="whatsapp" placeholder="Masukkan No WhatsApp" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            <small id="whatsappError" class="text-danger"></small>

            <label for="question">Pertanyaan Konsultasi:</label>
            <textarea id="question" name="pertanyaan" placeholder="Tulis pertanyaan Anda" rows="8"></textarea>
            <small id="questionError" class="text-danger"></small>

            <button type="submit">Lanjut ke Pembayaran</button>
        </form>
    </div>
</div>

@section('js')
<script>
    function validateForm() {
        let isValid = true;
        let whatsapp = document.getElementById("whatsappNumber").value.trim();
        let question = document.getElementById("question").value.trim();
        let whatsappError = document.getElementById("whatsappError");
        let questionError = document.getElementById("questionError");

        whatsappError.textContent = "";
        questionError.textContent = "";

        if (!whatsapp) {
            whatsappError.textContent = "Nomor WhatsApp wajib diisi.";
            isValid = false;
        } else if (whatsapp.length < 10 || whatsapp.length > 15) {
            whatsappError.textContent = "Nomor WhatsApp harus 10-15 digit.";
            isValid = false;
        }

        if (!question) {
            questionError.textContent = "Pertanyaan tidak boleh kosong.";
            isValid = false;
        } else if (question.length < 10) {
            questionError.textContent = "Pertanyaan minimal 10 karakter.";
            isValid = false;
        }

        return isValid;
    }
</script>
@endsection
@endsection

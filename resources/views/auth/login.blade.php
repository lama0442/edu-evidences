@extends('layouts.app_dashboard')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#0f172a] p-6">
    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl p-10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black text-indigo-600 mb-2">دخول الإدارة</h2>
            <p class="text-slate-500 font-bold italic">يرجى إدخال الرمز السري للوصول للمنصة</p>
        </div>

        <form method="POST" action="/admin-verify">
            @csrf
            <div class="mb-6">
                <input type="password" name="secret_code" 
                       class="w-full text-center text-2xl tracking-[1em] py-4 rounded-2xl border-2 border-slate-100 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition" 
                       placeholder="****" required autofocus>
            </div>

            @if($errors->any())
                <p class="text-red-500 text-center mb-4 font-bold">{{ $errors->first() }}</p>
            @endif

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all active:scale-95">
                تأكيد الدخول <i class="fas fa-unlock-alt ms-2"></i>
            </button>
        </form>
    </div>
</div>
@endsection
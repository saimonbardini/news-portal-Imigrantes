<?php
session_start();

// Proteção: se a sessão não existir, expulsa de volta para o login
if (!isset($_SESSION['intranet_logged_in']) || $_SESSION['intranet_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Intranet - Rádio Imigrantes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen font-sans">

<!-- Barra de Navegação Superior (Isolada do WordPress) -->
<header class="bg-[#1E73BE] text-white shadow-md">
    <div class="container mx-auto px-4 h-16 flex items-center justify-between">
        <div class="font-black text-xl tracking-tighter uppercase flex items-center gap-2">
            <i class="fa-solid fa-radio"></i> INTRANET
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium hidden sm:inline-block">Olá, <?php echo htmlspecialchars($_SESSION['intranet_user']); ?></span>
            <a href="logout.php" class="bg-white/20 hover:bg-white hover:text-[#1E73BE] transition-colors px-4 py-2 rounded text-sm font-bold flex items-center gap-2">
                Sair <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
    </div>
</header>

<div class="container mx-auto px-4 py-12 max-w-5xl">
    <div class="mb-10 border-b-2 border-[#1E73BE] pb-4">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Painel de Sistemas</h1>
        <p class="text-gray-600 mt-1">Selecione o módulo isolado que deseja gerenciar.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        
        <!-- Card: Eleições 2026 -->
        <a href="eleicoes.php" class="group block bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full -z-10 group-hover:scale-150 transition-transform duration-500"></div>
            
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-2xl mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors shadow-sm">
                <i class="fa-solid fa-check-to-slot"></i>
            </div>
            
            <h2 class="text-xl font-bold text-gray-900 mb-2">Eleições 2026</h2>
            <p class="text-sm text-gray-600">Sistema externo para gerenciar candidatos e pesquisas eleitorais.</p>
        </a>

    </div>
</div>

</body>
</html>
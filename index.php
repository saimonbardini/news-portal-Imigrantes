<?php
session_start();

// Se já estiver logado, redireciona para o painel
if (isset($_SESSION['intranet_logged_in']) && $_SESSION['intranet_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$erro = false;

// Processa o formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Credenciais de exemplo (no futuro, você pode conectar em um banco de dados)
    if ($usuario === 'admin' && $senha === 'radio123') {
        $_SESSION['intranet_logged_in'] = true;
        $_SESSION['intranet_user'] = 'Administrador';
        header("Location: dashboard.php");
        exit;
    } else {
        $erro = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Restrito - Rádio Imigrantes</title>
    <!-- Carregamos o Tailwind CSS via CDN já que não estamos no WordPress -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

<div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 relative">
    <div class="h-2 w-full bg-gradient-to-r from-[#1E73BE] to-[#336666]"></div>

    <div class="p-8 sm:p-10">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-[#1E73BE] mb-4">
                <i class="fa-solid fa-user-lock text-2xl"></i>
            </div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Acesso Restrito</h2>
            <p class="mt-2 text-sm text-gray-600">Sistema Gerencial Independente.</p>
        </div>

        <?php if ($erro): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-md">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                    <p class="ml-3 text-sm text-red-700 font-medium">Credenciais inválidas. Tente novamente.</p>
                </div>
            </div>
        <?php endif; ?>

        <form class="space-y-6" action="index.php" method="POST">
            <div>
                <label for="usuario" class="block text-sm font-bold text-gray-700 mb-1">Usuário</label>
                <input id="usuario" name="usuario" type="text" required class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1E73BE] focus:border-[#1E73BE] sm:text-sm bg-gray-50 focus:bg-white transition-colors" placeholder="Ex: admin">
            </div>

            <div>
                <label for="senha" class="block text-sm font-bold text-gray-700 mb-1">Senha</label>
                <input id="senha" name="senha" type="password" required class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1E73BE] focus:border-[#1E73BE] sm:text-sm bg-gray-50 focus:bg-white transition-colors" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-[#1E73BE] hover:bg-[#336666] shadow-md hover:shadow-lg transition-all items-center gap-2">
                Entrar no Sistema <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <a href="../" class="text-sm text-[#1E73BE] hover:underline flex items-center justify-center gap-1 font-medium">
                <i class="fa-solid fa-arrow-left"></i> Voltar para o portal de notícias
            </a>
        </div>
    </div>
</div>

</body>
</html>
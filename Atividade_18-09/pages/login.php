<?php
  require_once __DIR__ . '/../config/session.php';

  if(isset($_SESSION['user'])){
    echo "<script> console.log(".json_encode($_SESSION['user']).")</script>";
  } else{
    echo "<script>console.log(" . json_encode("Sessão não iniciada").")</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -</title>
    <link rel="stylesheet" href="../src/output.css">

</head>

<body class="bg-[#191825] flex items-center justify-center min-h-screen p-4">
    
    <div class="w-full max-w-sm p-8 space-y-6 bg-[#1A1A1D] rounded-xl shadow-2xl shadow-[#7A1CAC]/30 border border-[#4F1C51]">
        
        <h2 class="text-3xl font-bold text-[#FEFBF6] text-center tracking-widest uppercase">
            Acesso <br><span class="text-[#7A1CAC]">_User_</span>
        </h2>

        <form action="../index.php?controller=user&action=login" method="POST" class="space-y-4">
            
            <div>
              <label for="user_email" class="block text-sm font-medium text-[#FBF5E5] mb-1">
                [ E-mail ]
              </label>
              <input 
                type="text" 
                name="user_email" 
                id="user_email" 
                placeholder="usuário@sistema.com"
                class="w-full px-4 py-2 border-b-2 border-[#4F1C51] bg-transparent text-[#FEFBF6] placeholder-gray-500 focus:outline-none focus:border-[#7A1CAC] transition duration-300"
              >
            </div>

            <div>
                 <label for="user_passwd" class="block text-sm font-medium text-[#FBF5E5] mb-1">
                    [ Senha ]
                </label>
                <input 
                    type="password" 
                    name="user_passwd" 
                    id="user_passwd"
                    placeholder="••••••••"
                    class="w-full px-4 py-2 border-b-2 border-[#4F1C51] bg-transparent text-[#FEFBF6] placeholder-gray-500 focus:outline-none focus:border-[#7A1CAC] transition duration-300"
                >
            </div>

            <button 
                type="submit"
                class="w-full mt-6 py-2 tracking-widest bg-[#7A1CAC] text-[#FEFBF6] font-bold uppercase rounded-md hover:bg-[#4F1C51] transition duration-300 transform hover:scale-[1.02] shadow-lg shadow-[#7A1CAC]/50"
            > 
                > Entrar <
            </button>
            
        </form>
    </div>
</body>
</html>
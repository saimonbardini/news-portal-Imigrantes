/**
 * Lógica para o player de rádio minimizável
 */
function enhancedRadioPlayer() {
    const player = document.getElementById('radio-player-container');
    const toggleBtn = document.getElementById('toggle-player-size');
    const body = document.body;

    // Se os elementos essenciais não existirem, interrompe a execução
    if (!player || !toggleBtn) {
        return;
    }

    // Função para definir o estado (minimizado ou expandido)
    const setPlayerState = (state, animate = true) => {
        // Remove a transição para carregamento inicial sem "piscar"
        if (!animate) {
            player.style.transition = 'none';
            body.style.transition = 'none';
        } else {
            player.style.transition = ''; // Usa a transição definida no CSS
            body.style.transition = '';
        }

        if (state === 'minimized') {
            player.classList.add('is-minimized');
            body.classList.add('player-is-minimized');
            toggleBtn.setAttribute('aria-label', 'Expandir player');
        } else { // 'expanded'
            player.classList.remove('is-minimized');
            body.classList.remove('player-is-minimized');
            toggleBtn.setAttribute('aria-label', 'Minimizar player');
        }
        
        // Salva o estado no localStorage para persistir entre as páginas
        localStorage.setItem('radioPlayerState', state);

        // Força um reflow para garantir que a transição seja aplicada corretamente
        if (!animate) {
            void player.offsetWidth;
            player.style.transition = '';
            body.style.transition = '';
        }
    };

    // Adiciona o listener de clique ao botão
    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Impede que o clique se propague
        const isMinimized = player.classList.contains('is-minimized');
        setPlayerState(isMinimized ? 'expanded' : 'minimized');
    });

    // Carrega o estado inicial do player a partir do localStorage
    const savedState = localStorage.getItem('radioPlayerState');
    setPlayerState(savedState || 'expanded', false); // Carrega sem animar
}

// Executa a função quando o DOM está pronto e após cada navegação do Swup
document.addEventListener('DOMContentLoaded', enhancedRadioPlayer);
document.addEventListener('swup:pageView', enhancedRadioPlayer);
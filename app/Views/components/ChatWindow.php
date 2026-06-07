import React from 'react';

const ChatWindow = () => {
  return (
    {/* Container Principal: Ocupa todo o espaço restante (flex-1) */}
    <div className="flex-1 h-screen bg-[#313338] flex flex-col min-w-0 relative">
      
      {/* 1. Header do Canal */}
      <header className="h-12 border-b border-[#1F2023] flex items-center justify-between px-4 shrink-0 shadow-sm bg-[#313338] z-10">
        <div className="flex items-center gap-2 overflow-hidden">
          <span className="text-[#80848E] text-2xl font-light">#</span>
          <h1 className="font-semibold text-white truncate text-base">geral</h1>
          <span className="hidden md:inline-block text-sm text-[#949BA4] border-l border-[#3F4147] pl-3 ml-1 truncate">
            Canal focado em discussões gerais sobre o Farn-Chat
          </span>
        </div>

        {/* Ferramentas do Canto Direito (Busca, Notificações) */}
        <div className="flex items-center gap-4 text-[#B5BAC1]">
          <button className="hover:text-[#F2F3F5] transition-colors">🔔</button>
          <button className="hover:text-[#F2F3F5] transition-colors">📌</button>
          
          {/* Mini Barra de Busca interna do chat */}
          <div className="hidden sm:flex items-center bg-[#1E1F22] rounded px-2 py-1 w-36 focus-within:w-48 transition-all duration-200">
            <input 
              type="text" 
              placeholder="Buscar" 
              className="bg-transparent text-xs text-white outline-none w-full placeholder-[#949BA4]"
            />
            <span className="text-xs opacity-60">🔍</span>
          </div>
        </div>
      </header>

      {/* 2. Feed de Mensagens (Scroll Vertical Interno) */}
      <div className="flex-1 overflow-y-auto p-4 space-y-6 select-text scrollbar-thin">
        
        {/* Mensagem Estruturada (Padrão Discord/Slack: foto ao lado do texto) */}
        <div className="flex gap-4 items-start group hover:bg-[#2E3035] -mx-4 px-4 py-1 rounded transition-colors">
          {/* Avatar */}
          <div className="w-10 h-10 rounded-full bg-blue-600 flex-shrink-0 flex items-center justify-center text-white font-bold mt-0.5">
            FC
          </div>
          
          {/* Conteúdo da Mensagem */}
          <div className="flex-1 min-w-0">
            <div className="flex items-baseline gap-2">
              <span className="font-medium text-[#F2F3F5] hover:underline cursor-pointer text-sm">FarnDev</span>
              <span className="text-[10px] text-[#949BA4]">05/06/2026 18:35</span>
            </div>
            <p className="text-[#DBDEE1] text-sm leading-relaxed mt-1 break-words">
              Apanhamos bastante na validação dos tokens do JWT no login do Farn-Chat, mas finalmente a arquitetura de persistência está funcionando. Próximo passo é acoplar os WebSockets aqui neste feed.
            </p>
          </div>
        </div>

        {/* Mensagem Consecutiva do mesmo usuário (Otimização de UX: oculta o avatar) */}
        <div className="flex gap-4 items-start group hover:bg-[#2E3035] -mx-4 px-4 py-0.5 rounded transition-colors -mt-4">
          {/* Espaço simulando a largura do avatar para manter o alinhamento */}
          <div className="w-10 text-right opacity-0 group-hover:opacity-100 text-[10px] text-[#949BA4] select-none mt-1">
            18:36
          </div>
          <div className="flex-1 min-w-0">
            <p className="text-[#DBDEE1] text-sm leading-relaxed break-words">
              Montei a casca da interface em partes justamente para podermos depurar os flexboxes com calma. O que acharam desse espaçamento?
            </p>
          </div>
        </div>

      </div>

      {/* 3. Área de Input Fixo na Base */}
      <footer className="p-4 bg-[#313338] shrink-0">
        <div className="bg-[#383A40] rounded-lg px-4 py-2.5 flex items-start gap-4">
          
          {/* Botão de Upload/Anexo */}
          <button className="text-[#B5BAC1] hover:text-[#F2F3F5] transition-colors self-center bg-[#4E5058] hover:bg-[#6D6F78] w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold">
            +
          </button>
          
          {/* Input de Texto (Textarea para aceitar múltiplas linhas se necessário) */}
          <textarea 
            rows="1"
            placeholder="Conversar em #geral"
            className="flex-1 bg-transparent text-[#DBDEE1] placeholder-[#80848E] text-sm outline-none resize-none pt-0.5 max-h-36 overflow-y-auto"
          />

          {/* Botões de Ação Direta (Emoji, Gif, etc) */}
          <div className="flex items-center gap-3 self-center text-[#B5BAC1]">
            <button className="hover:text-[#F2F3F5] transition-colors text-lg">😀</button>
          </div>
          
        </div>
      </footer>

    </div>
  );
};

export default ChatWindow;

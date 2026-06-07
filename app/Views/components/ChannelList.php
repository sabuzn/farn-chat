import React from 'react';

const ChannelList = () => {
  return (
    {/* Container Principal: Fixo, largura de ~240px, flex-col */}
    <aside className="w-60 h-screen bg-[#2B2D31] flex flex-col shrink-0 z-10">
      
      {/* 1. Header do Servidor */}
      <header className="h-12 flex items-center justify-between px-4 font-semibold text-gray-100 hover:bg-[#35373C] cursor-pointer transition-colors shadow-[0_1px_2px_rgba(0,0,0,0.2)] z-20">
        <h2 className="truncate">Comunidade Farn-Chat</h2>
        {/* Ícone de seta para baixo (simulado) */}
        <span className="text-sm">⌄</span>
      </header>

      {/* 2. Área de Scroll: Lista de Canais */}
      <div className="flex-1 overflow-y-auto scrollbar-hide pt-4 pb-2 px-2 space-y-4">
        
        {/* Categoria: Canais de Texto */}
        <div>
          <div className="flex items-center text-xs font-semibold text-gray-400 hover:text-gray-200 cursor-pointer px-1 mb-1 tracking-wide">
            <span className="mr-1 text-[10px]">▼</span>
            CANAIS DE TEXTO
          </div>
          
          <div className="space-y-[2px]">
            {/* Canal Ativo */}
            <div className="flex items-center px-2 py-1.5 bg-[#404249] rounded-md cursor-pointer text-white group">
              <span className="text-gray-400 mr-1.5 text-lg font-light group-hover:text-gray-300">#</span>
              <span className="truncate font-medium">geral</span>
            </div>

            {/* Canal com Mensagem Não Lida (Texto mais claro/bold) */}
            <div className="flex items-center px-2 py-1.5 hover:bg-[#35373C] rounded-md cursor-pointer text-gray-200 group transition-colors">
              <span className="text-gray-400 mr-1.5 text-lg font-light">#</span>
              <span className="truncate font-semibold">dev-updates</span>
              {/* Pílula de não lido (opcional, estilo Discord usa apenas bold, mas aqui é uma alternativa) */}
              <div className="ml-auto w-1.5 h-1.5 bg-white rounded-full"></div>
            </div>

            {/* Canal Normal (Lido) */}
            <div className="flex items-center px-2 py-1.5 hover:bg-[#35373C] rounded-md cursor-pointer text-gray-400 group transition-colors">
              <span className="text-gray-500 mr-1.5 text-lg font-light group-hover:text-gray-400">#</span>
              <span className="truncate group-hover:text-gray-300 transition-colors">off-topic</span>
            </div>
          </div>
        </div>

        {/* Categoria: Canais de Voz */}
        <div>
          <div className="flex items-center text-xs font-semibold text-gray-400 hover:text-gray-200 cursor-pointer px-1 mb-1 tracking-wide">
            <span className="mr-1 text-[10px]">▼</span>
            CANAIS DE VOZ
          </div>
          
          <div className="space-y-[2px]">
            <div className="flex items-center justify-between px-2 py-1.5 hover:bg-[#35373C] rounded-md cursor-pointer text-gray-400 group transition-colors">
              <div className="flex items-center overflow-hidden">
                <span className="text-gray-500 mr-1.5 text-sm group-hover:text-gray-400">🔊</span>
                <span className="truncate group-hover:text-gray-300 transition-colors">Lounge</span>
              </div>
            </div>
          </div>
        </div>

      </div>

      {/* 3. Painel do Usuário (Footer Fixo) */}
      <footer className="h-[52px] bg-[#232428] flex items-center px-2 justify-between shrink-0">
        
        {/* Info do Usuário */}
        <div className="flex items-center gap-2 hover:bg-[#3F4147] p-1.5 rounded-md cursor-pointer transition-colors max-w-[120px]">
          <div className="w-8 h-8 rounded-full bg-blue-500 shrink-0 flex items-center justify-center text-white text-xs font-bold">
            FC
          </div>
          <div className="flex flex-col overflow-hidden">
            <span className="text-sm font-semibold text-white truncate leading-tight">Admin</span>
            <span className="text-xs text-gray-400 truncate leading-tight">Online</span>
          </div>
        </div>

        {/* Controles de Áudio/Configs */}
        <div className="flex items-center text-gray-400">
          <button className="w-8 h-8 flex items-center justify-center hover:bg-[#3F4147] hover:text-gray-200 rounded-md transition-colors">
            🎤
          </button>
          <button className="w-8 h-8 flex items-center justify-center hover:bg-[#3F4147] hover:text-gray-200 rounded-md transition-colors">
            🎧
          </button>
          <button className="w-8 h-8 flex items-center justify-center hover:bg-[#3F4147] hover:text-gray-200 rounded-md transition-colors">
            ⚙️
          </button>
        </div>

      </footer>

    </aside>
  );
};

export default ChannelList;

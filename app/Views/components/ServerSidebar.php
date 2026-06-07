import React from 'react';

const ServerSidebar = () => {
  return (
    {/* Container Principal: Fixo, escuro e com scroll oculto */}
    <nav className="w-[72px] h-screen bg-[#1E1F22] flex flex-col items-center py-3 gap-2 overflow-y-auto scrollbar-hide shrink-0 z-20">
      
      {/* Botão Home / Mensagens Diretas */}
      <div className="relative group flex items-center justify-center w-full cursor-pointer">
        {/* Indicador de Seleção (Pílula branca) */}
        <div className="absolute left-0 w-1 h-10 bg-white rounded-r-lg transition-all duration-300"></div>
        
        {/* Ícone */}
        <div className="w-12 h-12 bg-blue-600 rounded-[16px] flex items-center justify-center text-white transition-all duration-300 hover:rounded-[16px] hover:bg-blue-500 shadow-sm">
          {/* Símbolo do Farn-Chat */}
          <span className="font-bold text-lg">FC</span>
        </div>
      </div>

      {/* Separador */}
      <div className="w-8 h-[2px] bg-[#35363C] rounded-full my-1"></div>

      {/* Servidor 1: Com notificação de menção (Badge vermelho) */}
      <div className="relative group flex items-center justify-center w-full cursor-pointer">
        {/* Indicador de Atividade (Mensagem não lida) */}
        <div className="absolute left-0 w-1 h-2 bg-white rounded-r-lg group-hover:h-5 transition-all duration-300"></div>
        
        <div className="relative w-12 h-12 bg-[#313338] rounded-[24px] group-hover:rounded-[16px] group-hover:bg-[#5865F2] flex items-center justify-center text-white transition-all duration-300">
          <span className="font-medium">Dev</span>
          
          {/* Badge de Menção */}
          <div className="absolute -bottom-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-[3px] border-[#1E1F22]">
            3
          </div>
        </div>
      </div>

      {/* Servidor 2: Normal / Sem notificações */}
      <div className="relative group flex items-center justify-center w-full cursor-pointer">
        {/* Indicador oculto (aparece só no hover) */}
        <div className="absolute left-0 w-1 h-0 bg-white rounded-r-lg group-hover:h-5 transition-all duration-300"></div>
        
        {/* Se tivesse imagem, usaríamos a tag <img /> aqui dentro */}
        <div className="w-12 h-12 bg-[#313338] rounded-[24px] group-hover:rounded-[16px] group-hover:bg-green-500 flex items-center justify-center text-white transition-all duration-300">
          <span className="font-medium">UI</span>
        </div>
      </div>

      {/* Botão de Adicionar Novo Servidor */}
      <div className="relative group flex items-center justify-center w-full cursor-pointer mt-2">
        <div className="w-12 h-12 bg-[#313338] rounded-[24px] group-hover:rounded-[16px] group-hover:bg-emerald-500 flex items-center justify-center text-emerald-500 group-hover:text-white transition-all duration-300">
          <span className="text-2xl font-light">+</span>
        </div>
      </div>

      {/* Botão de Explorar Servidores */}
      <div className="relative group flex items-center justify-center w-full cursor-pointer">
        <div className="w-12 h-12 bg-[#313338] rounded-[24px] group-hover:rounded-[16px] group-hover:bg-blue-500 flex items-center justify-center text-gray-300 group-hover:text-white transition-all duration-300">
          <span className="text-xl">🧭</span>
        </div>
      </div>

    </nav>
  );
};

export default ServerSidebar;

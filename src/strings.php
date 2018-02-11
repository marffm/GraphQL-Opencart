<?php

return [
    // SYSTEM
    '1001' => 'Retorno com sucesso.',
    '1002' => 'Settings não encontrado.', // erro ao Carregar o arquivo Settings
    '1003' => 'Erro ao tentar converter id para padrão do mongoDb.', // Erro na conversão de string para ObjectId do Mongo
    '1004' => 'publicMethods não encontrado.', // Erro ao carregar o arquivo publicMethods
    '1005' => 'Busca não autorizada.', // Usuario não possui acesso ao metodo
    // GRAPHQL
    '1101' => 'Classe de Tipos não encontrada', // erro ao Instanciar uma Classe no RouterTypes
    '1102' => 'ScalarType não possui o metodo create.', // Ao Criar um tipo Scalar o mesmo deve obrigatoriamente possuir o metodo create.
    // DATABASE
    '1201' => 'Database não possui configuração de conexão no settings.', // Não há registro deste database no settings
    '1202' => 'Collection ou database não informados para conexão com MongoDb', // Não foi informado  todos os dados necessarios para conexão com o mongo
    '1203' => 'Erro ao inserir dados no database.', // Erro na função save da classe connection
    '1204' => 'Erro ao Atualizar dados.', // Erro no update da classe connection
    '1205' => 'Erro ao Deletar dados.', //Erro no delete da classe connection
    '9999' => 'Erro Desconhecido.'
];
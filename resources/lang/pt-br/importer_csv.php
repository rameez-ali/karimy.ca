<?php
return array (
  'seo' =>
  array (
    'upload' => 'Painel - Carregar arquivo CSV - :site_name',
    'csv-data-index' => 'Painel - Histórico de upload de CSV - :site_name',
    'csv-data-edit' => 'Painel - Analisar dados CSV - :site_name',
    'item-index' => 'Painel - Importação de listagem - :site_name',
    'item-edit' => 'Painel - Editar importação de listagem - :site_name',
  ),
  'alert' =>
  array (
    'upload-success' => 'Arquivo carregado com sucesso',
    'upload-empty-file' => 'O arquivo enviado tem conteúdo vazio',
    'fully-parsed' => 'O arquivo CSV foi totalmente analisado, não pode ser analisado novamente',
    'parsed-success' => 'Os dados do arquivo CSV foram analisados com êxito para o banco de dados de listagem temporária, vá para Menu da barra lateral> Ferramentas> Importador> Listagem para iniciar a importação final',
    'csv-file-deleted' => 'O arquivo CSV foi excluído do armazenamento de arquivos do servidor',
    'import-item-updated' => 'Informações da lista de importação atualizadas com sucesso',
    'import-item-deleted' => 'Informações de importação da lista excluídas com sucesso',
    'import-process-success' => 'Informações da lista importadas para a lista do site com sucesso',
    'import-process-error' => 'Foi encontrado um erro durante o processamento da importação, verifique o log de erros para obter detalhes',
    'import-all-process-completed' => 'Importar todo o processo de listagens concluído',
    'import-item-cannot-edit-success-processed' => 'Você não pode editar informações de listagem de importação que foram importadas com sucesso',
    'import-process-completed' => 'Processo de importação concluído',
    'import-process-no-listing-selected' => 'Selecione as listagens antes de iniciar o processo de importação',
    'import-process-no-categories-selected' => 'Selecione uma ou mais categorias antes de iniciar o processo de importação',
    'import-listing-process-in-progress' => 'Em andamento, aguarde a conclusão',
    'delete-import-listing-process-no-listing-selected' => 'Selecione as listagens antes de iniciar o processo de exclusão',
  ),
  'sidebar' =>
  array (
    'importer' => 'Importador',
    'upload-csv' => 'Carregar CSV',
    'upload-history' => 'Histórico de upload',
    'listings' => 'Listagens',
  ),
  'show-upload' => 'Carregar arquivo CSV',
  'show-upload-desc' => 'Esta página permite fazer upload de um arquivo CSV e analisá-lo em dados de listagem bruta para importação em etapas posteriores.',
  'csv-for-model' => 'Arquivo CSV para',
  'csv-for-model-listing' => 'Listagem',
  'choose-csv-file' => 'Escolher arquivo',
  'choose-csv-file-help' => 'tipo de arquivo de suporte: csv, txt, tamanho máximo: 10 MB',
  'upload' => 'Envio',
  'csv-skip-first-row' => 'Pular primeira linha',
  'filename' => 'Nome do arquivo',
  'progress' => 'Progresso analisado',
  'uploaded-at' => 'Carregado em',
  'model-for' => 'Modelo',
  'import-csv-data-index' => 'Histórico de upload de arquivo CSV',
  'import-csv-data-index-desc' => 'Esta página mostra todos os arquivos CSV carregados e seu progresso analisado.',
  'parse' => 'Analisar',
  'import-csv-data-edit' => 'Analisar dados do arquivo CSV',
  'import-csv-data-edit-desc' => 'Esta página permite que você analise os dados de um arquivo CSV que você carregou.',
  'start-parse' => 'Começar a analisar',
  'import-csv-data-parse-error' => 'Ocorreu um erro, recarregue a página para continuar a analisar as linhas restantes.',
  'parsed-percentage' => ':parsed_count de :total_count registros analisados',
  'column' => 'Coluna',
  'column-item-title' => 'título da lista',
  'column-item-slug' => 'listando lesma',
  'column-item-address' => 'endereço de listagem',
  'column-item-city' => 'cidade da lista',
  'column-item-state' => 'estado da lista',
  'column-item-country' => 'país da lista',
  'column-item-lat' => 'lista lat',
  'column-item-lng' => 'listando lng',
  'column-item-postal-code' => 'listar código postal',
  'column-item-description' => 'descrição da lista',
  'column-item-phone' => 'lista de telefone',
  'column-item-website' => 'site de listagem',
  'column-item-facebook' => 'listando facebook',
  'column-item-twitter' => 'listando twitter',
  'column-item-linkedin' => 'listar o LinkedIn',
  'column-item-youtube-id' => 'listando id do youtube',
  'delete-file' => 'Excluir arquivo',
  'csv-file' => 'Arquivo CSV',
  'import-errors' =>
  array (
    'user-not-exist' => 'O usuário não existe',
    'item-status-not-exist' => 'A listagem deve estar no status submetido, publicado ou suspenso',
    'item-featured-not-exist' => 'A listagem apresentada deve ser sim ou não',
    'country-not-exist' => 'O país não existe, adicione o país em Localização> País> Adicionar país',
    'state-not-exist' => 'O estado não existe, adicione o estado em Localização> Estado> Adicionar estado',
    'city-not-exist' => 'A cidade não existe, adicione a cidade em Local> Cidade> Adicionar cidade',
    'item-title-required' => 'O título da lista é obrigatório',
    'item-description-required' => 'A descrição da lista é obrigatória',
    'item-postal-code-required' => 'O código postal da lista é obrigatório',
    'categories-required' => 'A listagem deve ser atribuída a uma ou mais categorias',
    'import-item-cannot-process-success-processed' => 'Você não pode processar informações de listagem de importação que foram importadas com sucesso',
  ),
  'import-listing-index' => 'Importar listagens',
  'import-listing-index-desc' => 'Esta página mostra todos os dados de listagem analisados do arquivo CSV. Estes são dados de listagem brutos, que estão prontos para serem importados para listagens de sites.',
  'import-listing-status-not-processed' => 'Não processado',
  'import-listing-status-success' => 'Processado com sucesso',
  'import-listing-status-error' => 'Processado com Erro',
  'import-listing-order-newest-processed' => 'Processado mais recente',
  'import-listing-order-oldest-processed' => 'Processado mais antigo',
  'import-listing-order-newest-parsed' => 'Mais recente analisado',
  'import-listing-order-oldest-parsed' => 'Mais antigo analisado',
  'import-listing-order-title-a-z' => 'Título (AZ)',
  'import-listing-order-title-z-a' => 'Título (ZA)',
  'import-listing-order-city-a-z' => 'Cidade (AZ)',
  'import-listing-order-city-z-a' => 'Cidade (ZA)',
  'import-listing-order-state-a-z' => 'Estado (AZ)',
  'import-listing-order-state-z-a' => 'Estado (ZA)',
  'import-listing-order-country-a-z' => 'País (AZ)',
  'import-listing-order-country-z-a' => 'País (ZA)',
  'select' => 'Selecione',
  'import-listing-title' => 'Título',
  'import-listing-city' => 'Cidade',
  'import-listing-state' => 'Estado',
  'import-listing-country' => 'País',
  'import-listing-status' => 'Status',
  'import-listing-detail' => 'Detalhe',
  'import-listing-slug' => 'Lesma',
  'import-listing-address' => 'Endereço',
  'import-listing-lat' => 'Latitude',
  'import-listing-lng' => 'Longitude',
  'import-listing-postal-code' => 'Código postal',
  'import-listing-description' => 'Descrição',
  'import-listing-phone' => 'telefone',
  'import-listing-website' => 'Local na rede Internet',
  'import-listing-facebook' => 'Facebook',
  'import-listing-twitter' => 'Twitter',
  'import-listing-linkedin' => 'LinkedIn',
  'import-listing-youtube-id' => 'Id do Youtube',
  'import-listing-do-not-parse' => 'NÃO PARSE',
  'import-listing-source' => 'Fonte',
  'import-listing-source-csv' => 'Upload de arquivo CSV',
  'import-listing-error-log' => 'Log de erros',
  'import-listing-edit' => 'Editar importação de listagem',
  'import-listing-edit-desc' => 'Esta página permite que você edite as informações da lista de importação, bem como processe as informações da lista de importação individual para a lista do site.',
  'import-listing-information' => 'Informações de listagem de importação',
  'choose-import-listing-preference' => 'Importar para a lista',
  'choose-import-listing-categories' => 'Escolha uma ou mais categorias',
  'choose-import-listing-owner' => 'Proprietário da lista',
  'choose-import-listing-status' => 'Status da lista',
  'choose-import-listing-featured' => 'Listagem em destaque',
  'import-listing-button' => 'Importar agora',
  'choose-import-listing-preference-selected' => 'Importar selecionados para a lista',
  'import-listing-selected-button' => 'Importar Selecionado',
  'import-listing-selected-modal-title' => 'Importar listagens selecionadas',
  'import-listing-selected-total' => 'Total para importar',
  'import-listing-selected-success' => 'Sucesso',
  'import-listing-selected-error' => 'Erro',
  'import-listing-per-page-10' => '10 linhas',
  'import-listing-per-page-25' => '25 linhas',
  'import-listing-per-page-50' => '50 linhas',
  'import-listing-per-page-100' => '100 linhas',
  'import-listing-per-page-250' => '250 linhas',
  'import-listing-per-page-500' => '500 linhas',
  'import-listing-per-page-1000' => '1000 linhas',
  'import-listing-select-all' => 'Selecionar tudo',
  'import-listing-un-select-all' => 'Desmarque todos',
  'csv-parse-in-progress' => 'Análise do arquivo CSV em andamento, aguarde a conclusão',
  'error-notify-modal-close-title' => 'Erro',
  'error-notify-modal-close' => 'Fechar',
  'csv-file-upload-listing-instruction' => 'Instrução',
  'csv-file-upload-listing-instruction-columns' => 'Colunas para listagem: título, slug (opção), endereço (opção), cidade, estado, país, latitude (opção), longitude (opção), código postal, descrição, telefone (opção), site (opção), facebook (opção ), twitter (opção), linkedin (opção), id do youtube (opção).',
  'csv-file-upload-listing-instruction-tip-1' => 'Embora o processo de análise do arquivo CSV faça o possível para adivinhar, certifique-se de que o nome da cidade, estado e país correspondem aos dados de localização (Barra Lateral> Local> País, Estado, Cidade) do seu site.',
  'csv-file-upload-listing-instruction-tip-2' => 'Se o seu site for hospedado em hospedagem compartilhada, tente fazer upload de um arquivo CSV com menos de 15.000 linhas de cada vez para evitar o erro de tempo máximo de execução excedido.',
  'csv-file-upload-listing-instruction-tip-3' => 'Agrupe os arquivos CSV por categorias para sua conveniência. Por exemplo, restaurantes em um arquivo CSV denominado restaurant.csv e hotéis em outro arquivo CSV denominado hotel.csv.',
  'import-listing-delete-selected' => 'Excluir selecionado',
  'import-listing-delete-progress' => 'Excluindo ... aguarde',
  'import-listing-delete-progress-deleted' => 'apagado',
  'import-listing-delete-complete' => 'Feito',
  'import-listing-delete-error' => 'Ocorreu um erro, recarregue a página para continuar excluindo os registros restantes.',
  'import-listing-import-button-progress' => 'Importando ... aguarde',
  'import-listing-import-button-complete' => 'Feito',
  'import-listing-import-button-error' => 'Ocorreu um erro, recarregue a página para continuar importando os registros restantes.',
  'import-listing-markup' => 'Markup',
  'import-listing-markup-help' => 'Dê algumas palavras para distinguir com outros lotes de arquivos',
  'import-listing-markup-all' => 'Todas as marcações',
);
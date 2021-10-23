<?php 

	require "../app/conexao.php"; 
	require "../app/tarefa.model.php"; 
	require "../app/tarefa.service.php"; 


	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir') {

		$tarefa = new Tarefa();
		$tarefa->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->add();

		header('Location: nova_tarefa.php?inclusao=ok');

	}else if($acao == 'listar'){

		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$listaTarefas = $tarefaService->list();
	
	}else if($acao == 'atualizar'){

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_POST['id']);
		$tarefa->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		
		if($tarefaService->update()){

			if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
				header('Location: index.php');
			}else{
				header('Location: todas_tarefas.php');
			}
		}

	}else if($acao == 'remover'){

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);

		$tarefaService->delete();

		if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
			header('Location: index.php');
		}else{
			header('Location: todas_tarefas.php');
		}	

	}else if($acao == 'checkOn'){

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);
		$tarefa->__set('id_status', 2);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);

		$tarefaService->checkOn();

		if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
			header('Location: index.php');
		}else{
			header('Location: todas_tarefas.php');
		}
	
	}else if($acao == 'recuperarTarefasPendentes'){

		$tarefa = new Tarefa();
		$tarefa->__set('id_status', 1);
		
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$listTarefasPendentes = $tarefaService->listTarefasPendentes();

	}





?>
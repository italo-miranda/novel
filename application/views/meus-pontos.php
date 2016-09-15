<!-- Aqui é a área do conteúdo -->
<div id="conteudo" class="col-md-12 col-xs-12 well">

<?php
if($dadosPalavras){
	echo '<div class="row">';
		echo '<h2 class="centered afastado-1pc">Estatísticas do nível Palavra</h2>';
		echo '<div class="col-md-8 col-xs-12 centered">';
			echo '<table class="columns col-md-12 col-xs-12">';
	      		echo '<tr>';
		        	echo '<td><div id="graficoPalavras"></div></td>';
		        	echo '<td><div id="graficoPontuacaoPalavras"></div></td>';
		      	echo '</tr>';
		    echo '</table>';
		echo '</div>';
		echo '<div class="col-md-4 col-xs-12 dadosPalavras">';
		
			$tamanhoPalavras = count($dadosPalavras);							
			echo '<input type="hidden" id="tamanhoPalavras" value="'.$tamanhoPalavras.'"/>';
			for ($i = 0; $i < $tamanhoPalavras; $i++){
				echo '<input type="hidden" id="grafemaPalavras'.$i.'" value="'.$dadosPalavras[$i]->tipoGrafema.'"/>';
				echo '<input type="hidden" id="pontuacaoPalavras'.$i.'" value="'.$dadosPalavras[$i]->pontuacao.'"/>';
				echo '<input type="hidden" id="duracaoPalavras'.$i.'" value="'.$dadosPalavras[$i]->duracao.'"/>';
			}

		echo '</div>';
	echo '</div>';
}

if($dadosTextos){
	echo '<div class="row">';
		echo '<h2 class="centered afastado-1pc">Estatísticas do nível Texto</h2>';
			echo '<div class="col-md-8 col-xs-12 centered">';
				
			echo '</div>';
			echo '<div class="col-md-4 col-xs-12 dadosTextos">';

				/*
				$tamanhoTestos = count($dadosTextos);
				echo '<input type="hidden" id="tamanhoTextos" value="'.$tamanhoPalavras.'"/>';
					for ($i = 0; $i < $tamanho; $i++){
						echo '<input type="hidden" id="grafemasTextos'.$i.'" value="'.$dadosTextos[$i]->grafemas.'"/>';
						echo '<input type="hidden" id="pontuacaoTextos'.$i.'" value="'.$dadosTextos[$i]->pontuacao.'"/>';
						echo '<input type="hidden" id="duracaoTextos'.$i.'" value="'.$dadosTextos[$i]->duracao.'"/>';
					}
					*/
		echo '</div>';
	echo '</div>';
}

if($dadosTestes){	
	echo '<div class="row">';
		echo '<h2 class="centered afastado-1pc">Estatísticas do nível Teste</h2>';
			echo '<div class="col-md-8 col-xs-12 centered">';
				echo '<table class="columns col-md-12 col-xs-12">';
		      		echo '<tr>';
			        	echo '<td><div id="graficoTestes"></div></td>';
			        	echo '<td><div id="graficoPontuacaoTestes"></div></td>';
			      	echo '</tr>';
			    echo '</table>';
			echo '</div>';
			echo '<div class="col-md-4 col-xs-12 dadosTestes">';
				
				$tamanhoTestes = count($dadosTestes);
				echo '<input type="hidden" id="tamanhoTestes" value="'.$tamanhoTestes.'"/>';			
				for ($i = 0; $i < $tamanhoTestes; $i++){
					echo '<input type="hidden" id="grafemaTestes'.$i.'" value="'.$dadosTestes[$i]->tipoGrafema.'"/>';
					echo '<input type="hidden" id="pontuacaoTestes'.$i.'" value="'.$dadosTestes[$i]->pontuacao.'"/>';
					echo '<input type="hidden" id="duracaoTestes'.$i.'" value="'.$dadosTestes[$i]->duracao.'"/>';
				}
		echo '</div>';
	echo '</div>';
}


?>
<script type="text/javascript">

 	//Para desenhar os gráficos, utiliza-se aqui
 	//a ferramenta Google Charts

     // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(desenharTabelaPalavras);
      google.charts.setOnLoadCallback(desenharTabelaPontuacaoPalavras);
      google.charts.setOnLoadCallback(desenharTabelaTestes);
      google.charts.setOnLoadCallback(desenharTabelaPontuacaoTestes);     
          

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
	function desenharTabelaPalavras() {

		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Grafema');
		data.addColumn('number', 'Duração');
		data.addColumn('number', 'Pontuação');
		var tamanho = document.getElementById('tamanhoPalavras').value;        
		for (var i = 0; i < tamanho; i++) {
			var string = "grafemaPalavras"+i;
		  	var grafema = document.getElementById(string).value;	    	      		      	
		  	string = "pontuacaoPalavras"+i;
		  	var pontuacao = parseInt(document.getElementById(string).value);
		  	string = "duracaoPalavras"+i;	      	
		  	var duracao = parseInt(document.getElementById(string).value);		      	
		  	data.addRow([''+grafema+'', duracao, pontuacao]);         

		}

		// Set chart options
		var options = {'title':'Pontuação e duração por grafema jogado',
		               'width':450,
		               'height':400};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.BarChart(document.getElementById('graficoPalavras'));
		chart.draw(data, options);                

	}

	function desenharTabelaPontuacaoPalavras() {

		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Grafema');
		data.addColumn('number', 'Pontuação');
		var tamanho = document.getElementById('tamanhoPalavras').value;        
		for (var i = 0; i < tamanho; i++) {
			var string = "grafemaPalavras"+i;
		  	var grafema = document.getElementById(string).value;	    	      		      	
		  	string = "pontuacaoPalavras"+i;
		  	var pontuacao = parseInt(document.getElementById(string).value);
		  	string = "duracaoPalavras"+i;	      	
		  	data.addRow([''+grafema+'', pontuacao]);         
		}

		// Set chart options
		var options = {'title':'Pontuação por grafema jogado',
		               'width':400,
		               'height':400};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('graficoPontuacaoPalavras'));
		chart.draw(data, options);                

	}
		

      //GRÁFICOS DOS TESTES
      
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
	function desenharTabelaTestes() {

		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Grafema');
		data.addColumn('number', 'Duração');
		data.addColumn('number', 'Pontuação');
		var tamanho = document.getElementById('tamanhoTestes').value;        		
		for (var i = 0; i < tamanho; i++) {
			var string = "grafemaTestes"+i;
		  	var grafema = document.getElementById(string).value;	    	      		      	
		  	string = "pontuacaoTestes"+i;
		  	var pontuacao = parseInt(document.getElementById(string).value);
		  	string = "duracaoTestes"+i;	      	
		  	var duracao = parseInt(document.getElementById(string).value);		      	
		  	data.addRow([''+grafema+'', duracao, pontuacao]);         

		}

		// Set chart options
		var options = {'title':'Pontuação e duração por grafema jogado',
		               'width':450,
		               'height':400};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.BarChart(document.getElementById('graficoTestes'));
		chart.draw(data, options);                

	}

	function desenharTabelaPontuacaoTestes() {

		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Grafema');
		data.addColumn('number', 'Pontuação');
		var tamanho = document.getElementById('tamanhoTestes').value;        
		for (var i = 0; i < tamanho; i++) {
			var string = "grafemaTestes"+i;
		  	var grafema = document.getElementById(string).value;	    	      		      	
		  	string = "pontuacaoTestes"+i;
		  	var pontuacao = parseInt(document.getElementById(string).value);	      	
		  	data.addRow([''+grafema+'', pontuacao]);         
		}

		// Set chart options
		var options = {'title':'Pontuação por grafema jogado',
		               'width':400,
		               'height':400};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('graficoPontuacaoTestes'));
		chart.draw(data, options);                

	}

</script>	
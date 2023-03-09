<?php
//include_once(__DIR__ . '/utils/functions_relatorio.php');

echo '<pre>';
$pdo = new PDO('sqlite:mydb.db');
function teste(){
	global $pdo;
	$statement = $pdo->query("SELECT * FROM fornecedores ORDER BY valor");
	while ($row = $statement->fetchAll()) {
    	return $row;
	}
}
$lista = teste();
print_r($lista);

/*
if($statement){
	$result = $statement->query->fetchAll();
	echo $result;
}*/
$idProduto = 16;
//$produtos = buscaProdutos();
//$fornecedores = todosFornecedores();
$scriptteste = "<script type='text/javascript' src='dist/jquery-3.6.0.js'></script>
        		<script type='text/javascript' src='dist/jquery.mask.js'></script>
        		<script type='text/javascript'>
        		$(document).ready(function() {
                $('#preco*').mask('#.##0,00',{reverse:true});
            })
            </script>";

           
echo $scriptteste;


/*
foreach($fornecedores as $fornecedor){
	print_r($fornecedor);	
}
*/

$tableAc = '<table id="tabelaFornecedor">';
$tableAc .= '<thead>';
//$tableAc.= '<table border="3"><tbody><tr align="center">';
$tableAc .= '<style>table, td {border: 1px solid black}</style>';
$tableAc .= '<tr><td>Produto: Nome aqui</td></tr>';
$tableAc .= '<tr>';
	$tableAc .= '<td><button onClick="testeBotao()">Inserir Novo Fornecedor</button></td>';
	$tableAc .= '<form action="" method="post">';
	$tableAc .= "<td><select id='myDIV' name='Fruit'>";
	$tableAc .= "<option>---Escolher Fornecedor---</option>";

	//foreach($fornecedores as $fornecedor){
	$tableAc .= "<option value='Submarino:187'>Submarino</option>";
	$tableAc .= "<option value='Carrefour:254'>Carrefour</option>";
	$tableAc .= "<option value='Americanas:395'>Americanas</option>";
	$tableAc .= "<option value='Shoppee:488'>Shoppee</option>";
	$tableAc .= "<option value='Wish:576'>Wish</option>";
	//}
	$tableAc .= "</select>";
	//$tableAc .= '<td><button onClick="inserirForn()">Adicionar</button></td>'; 
	//$tableAc .= "<td><input type='text' name='preco' placeholder='Digita o preço'></td>";
	//$tableAc .= '<td><input type="number" name="preco" min="1" step="any" placeholder="Digite o preço"></td>';
	$tableAc .= '<td><input type="text" name="preco" placeholder="0,00"></td>';
	$tableAc .= "<td><input type='date' name='data' placeholder='dd-mm-yyyy'></td>";
	$tableAc .= '<td><input type="submit" name="submit" value="Choose options"></td>';
	$tableAc .= '</form>';
	
    if(isset($_POST['submit'])){
    if(!empty($_POST['Fruit'])) {
    	unset($selected);
		unset($forn);
		unset($preco);
		unset($prev_entrega); 
        $selected = $_POST['Fruit'];
        $preco = $_POST['preco'];
        //$preco2 = number_format($preco, 2, ',', '.');
        $prev_entrega = $_POST['data'];
        $forn = explode(':', $selected);
        echo 'Voce escolheu: ' . $forn[0]  . ' cujo id é ' . $forn[1] . ' o preco e R$' . $preco . ' com previsao de entrega para ' . $prev_entrega;
        $sql = "INSERT INTO fornecedores (id, nome, valor, prev_entrega) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
		$stmt->execute([$forn[1], $forn[0], $preco, $prev_entrega]);
    } else {
        echo 'Please select the value.';
    }
    }
    
	//$tabelaAc .= "<input type='submit' onClick='inserirForn()' value='{$fornecedor->CODIGO}'/>";      
	$tableAc .= "<td><label>Status:</label></td>";
$tableAc .= '</tr>';
$tableAc .= "<tr>";
	$tableAc .= '<td>Código Fornecedor</td>';
	$tableAc .= '<td>Fornecedor</td>';
	$tableAc .= '<td>Preço</td>';
	$tableAc .= '<td>Prazo de entrega</td>';
	$tableAc .= '</tr>';
	$tableAc .= '</thead>';
	//$tableAc .= '<tbody>';
	//$tableAc .= '</table>';

	
/*
$tableAc .= '<script>
function inserirForn() {
	var table = document.getElementById("tabelaFornecedor");
	var e = document.getElementById("myDIV");
	var idForn = e.value;
	var nmForn = e.options[e.selectedIndex].text;
	var sql = INSERT INTO fornecedores VALUES (idForn, nmForn);
}
</script>';
*/
$tableAc .= '<script>
function testeBotao() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>';


/*var row = table.insertRow(3);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);
	cell1.innerHTML = "<td>" + idForn + "</td>";
	cell2.innerHTML = "<td>" + nmForn + "</td>";;
	cell3.innerHTML = "Teste";
	cell4.innerHTML = "Teste";
	*/
/*
$tableA .= "<td><input type='text' name='preco' placeholder='Digita o preço'></td>";
	$tableA .= "<td><input type='date' name='data' placeholder='Previsão de entrega'></td>";
*/

echo $tableAc;
foreach ($lista as $loja) {
	$tableA = "<tr>";
	$tableA .= "<td>{$loja['id']}</td>";
	$tableA .= "<td>{$loja['nome']}</td>";
	//$tableA .= "<td>"."R$".number_format($loja['valor'], 2, ',', '.')."</td>";
	$tableA .= "<td id='preco'>{$loja['valor']}</td>";
	//$tableA .= "<td id='data'>{$loja['prev_entrega']}</td>";
	$dataUSA = $loja['prev_entrega'];
	$tableA .= "<td>".FormataStringData($dataUSA)."</td>";
	$tableA .= '</tr>';
	echo $tableA;
		
	
	
}
$tableA .= '</table>';
function FormataStringData($data) {
  $br = explode('-', $data);
  $dia = $br['2'];
  $mes = $br['1'];
  $ano = $br['0'];

  return $dia."/".$mes."/".$ano;
 // return;
  // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
}



?>




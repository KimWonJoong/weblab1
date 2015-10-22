<!DOCTYPE html>
<html>
	<head>
		<title>Fruit Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
			if (empty($_POST['name']) || empty($_POST['mem_num']) || empty($_POST['option']) || empty($_POST['fruits']) || empty($_POST['quantity']) || empty($_POST['credit_num']) || empty($_POST['credit_card'])){
		?>

		<!-- Ex 4 : 
			Display the below error message : 
			
		--> 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), or single white space.
			} elseif (preg_match('/^[a-z]+([-]{1}[a-z]+){0,}[ ]?[a-z]+([-]{1}[a-z]+){0,}$/i', $_POST['name']) == false) { 
		?>

		<!-- Ex 5 : 
			Display the below error message : 
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
			} elseif ((($_POST['credit_card'] == 'visa') && !preg_match('/^4\d{15}$/', $_POST['credit_num'])))  {
		?>

		<!-- Ex 5 : 
			Display the below error message : 
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
			
		<?php
		# if all the validation and check are passed 
			} else {
		?>

			<h1>Thanks!</h1>
			<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<?php
			if(isset($_POST['name'])){
				$name = $_POST['name'];
			}else{
				$name = '';
			}

			if(isset($_POST['mem_num'])){
				$mem_num = $_POST['mem_num'];
			}else{
				$mem_num = '';
			}

			if(isset($_POST['option'])){
				$option = $_POST['option'];
			}else{
				$option = '';
			}

			if(isset($_POST['fruits'])){
				$fruits = $_POST['fruits'];
			}else{
				$fruits = '';
			}

			if(isset($_POST['quantity'])){
				$quantity = $_POST['quantity'];
			}else{
				$quantity= '';
			}

			if(isset($_POST['credit_num'])){
				$credit_num = $_POST['credit_num'];
			}else{
				$credit_num = '';
			}

			if(isset($_POST['credit_card'])){
				$credit_card = $_POST['credit_card'];
			}else{
				$credit_card = '';
			}
		?>
		<ul> 
			<li>Name: <?= $name ?></li>
			<li>Membership Number: <?= $mem_num ?></li>
			<li>Options: <?= processCheckbox($option) ?></li>
			<li>Fruits: <?= $fruits ?> - <?= $quantity ?></li>
			<li>Credit <?= $credit_num ?></li>
		</ul>
		
		<!-- Ex 3 :-->
			<p>This is the sold fruits count list:</p>
		<?php
			$filename = "customers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'customers.txt' in the format of : "name;membershipnumber;fruit;number".
			 * For example, "Scott Lee;20110115238;apple;3"
			 */

			file_put_contents($filename, $name.';'.$mem_num.';'.$fruits.';'.$quantity."\n", FILE_APPEND);
		?>
		
		<!-- Ex 3: list the number of fruit sold in a file "customers.txt".
			Create unordered list to show the number of fruit sold -->
		<ul>
		<?php 
		#$fruitcounts = soldFruitCount($filename);
		#foreach() {
		?>
		<!-- <li></li> -->
		<?php
		#}
		?>
		</ul>
		
		<?php
			}
		?>
		
		<?php
			/* Ex 3 :
			* Get the fruits species and the number from "customers.txt"
			* 
			* The function parses the content in the file, find the species of fruits and count them.
			* The return value should be an key-value array
			* For example, array("Melon"=>2, "Apple"=>10, "Orange" => 21, "Strawberry" => 8)
			*/

			function processCheckbox($names){ 
				$options = '';
				foreach ($names as $option) {
					$options = $options.','.$option;
				}
				$options = substr($options, 1);
				return $options;
			}

			function soldFruitCount($filename) {
			}
		?>
		
	</body>
</html>

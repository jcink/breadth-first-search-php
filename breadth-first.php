<?php
     class node {
 
			public $name;
			public $left;
			public $right;
			public $right_cost = 0;
			public $left_cost = 0;
			public $level;

           public function node($name) {
                  $this->name = $name; 
                  $this->left = NULL; 
                  $this->right = NULL; 
                  $this->level = NULL;
           }

     };

     function breadth_first($node, $goal) {
			
		   $total_cost = 0;
           $node->level = 1;
           $q = array($node);
           $curr_level = $node->level;
           $output = array();

           while(count($q) > 0) {
			   
                 $curr_node = array_shift($q);
				
                 if($curr_node->level > $curr_level) {
                    $curr_level++;
                    array_push($output,"\n");
                 }
				
                 array_push($output,$curr_node->name . " ");

				 
				/* Traverse left on the level as long as it is on the same level and not null */
				
                 if($curr_node->left != NULL) {
					$curr_node->left->level = $curr_level + 1; 
                    array_push($q, $curr_node->left);
					
					// Keep track of total cost
					echo "Cost from node {$curr_node->name} to node {$curr_node->left->name}: {$curr_node->left_cost}\n";
					$total_cost += $curr_node->left_cost;
				
					// Goal check -- did we find the node we're looking for?
					// If so, break and stop searching				
					if($curr_node->left->name == $goal) {
						$curr_node = $curr_node->left;
						break;
					}
					
                 }              
				
				/* Traverse right on the level as long as it is on the same level and not null */
                 if($curr_node->right != NULL) {
                    $curr_node->right->level = $curr_level + 1;
                    array_push($q, $curr_node->right);	

					// Keep track of total cost
					echo "Cost from node {$curr_node->name} to node {$curr_node->right->name}: {$curr_node->right_cost}\n";
					$total_cost += $curr_node->right_cost;
					
					// Goal check -- did we find the node we're looking for?
					// If so, break and stop searching
					if($curr_node->right->name == $goal) {
						$curr_node = $curr_node->right;
						break;
					}
                 }
				 
           }

		   echo "\nTotal Search Path Cost: {$total_cost}\n\n";
		   
     }       
	  

	$start = new node('S');
	$start->left = new node('A');
	$start->left_cost = 1;
	$start->right = new node('B');
	$start->right_cost = 2;


	$start->left->left = new node('D');
	$start->left->left_cost = 3;	

	$start->left->right = new node('E');
	$start->left->right_cost = 4;

	$start->right->left = new node('F');
	$start->right->left_cost = 5; 

	$start->right->right = new node('G');
	$start->right->right_cost = 7; 



	$start->left->left->left = new node('J');
	$start->left->left->left_cost = 6;	

	$start->left->left->right = new node('K');
	$start->left->left->right_cost = 7;

	echo "Visited Nodes:\n\n";
	echo breadth_first($start, 'F');
?>
<?php
	// G O O G L E   W E B   F O N T S
	//--------------------------------------------------------	
	add_action( 'wp_head', 'atp_google_webfonts' );		
	//
	//--------------------------------------------------------
	if (!function_exists( "atp_google_webfonts")) {
		function atp_google_webfonts() {
			global  $iva_of_options;
			$google_fonts = array(	
				array( 	'name' => "ABeeZee",					'variant' => ':400,400italic'),
				array( 	'name' => "Abel",						'variant' => ''),
				array( 	'name' => "Abril Fatface",				'variant' => ''),
				array( 	'name' => "Aclonica",					'variant' => ''),
				array( 	'name' => "Acme", 						'variant' => ''),
				array( 	'name' => "Actor", 						'variant' => ''),
				array( 	'name' => "Adamina", 					'variant' => ''),
				array( 	'name' => "Advent Pro", 				'variant' => ':400,100,200,300,500,600,700'),
				array( 	'name' => "Aguafina Script",			'variant' => ''),
				array( 	'name' => "Aladin",		 				'variant' => ''),
				array(  'name' => "Aldrich", 					'variant' => ''),
				array(  'name' => "Alegreya", 					'variant' => ':400,700'),
				array( 	'name' => "Alex Brush",		 			'variant' => ''),
				array( 	'name' => "Alfa Slab One",	 			'variant' => ''),
				array( 	'name' => "Alice",	 					'variant' => ''),
				array( 	'name' => "Alike",	 					'variant' => ''),
				array( 	'name' => "Alike Angular",	 			'variant' => ''),
				array( 	'name' => "Allan",						'variant' => ':400,700'),
				array( 	'name' => "Allerta",	 				'variant' => ''),
				array( 	'name' => "Allerta Stencil",			'variant' => ''),
				array( 	'name' => "Allura",	 					'variant' => ''),
				array( 	'name' => "Amarante",	 				'variant' => ''),
				array( 	'name' => "Amaranth",	 				'variant' => ':400,700'),
				array( 	'name' => "Amethysta",	 				'variant' => ''),
				array( 	'name' => "Anaheim",	 				'variant' => ''),
				array( 	'name' => "Andada",	 					'variant' => ''),
				array( 	'name' => "Andika",	 					'variant' => ''),
				array( 	'name' => "Anonymous Pro",	 			'variant' => ':400,700'),
				array( 	'name' => "Antic",	 					'variant' => ''),
				array( 	'name' => "Antic Didone",	 			'variant' => ''),
				array( 	'name' => "Antic Slab",	 				'variant' => ''),
				array( 	'name' => "Anton",	 					'variant' => ''),
				array( 	'name' => "Arapey",	 					'variant' => ':400'),
				array( 	'name' => "Arbutus Slab",	 			'variant' => ''),
				array( 	'name' => "Architects Daughter",		'variant' => ''),
				array( 	'name' => "Archivo Black",	 			'variant' => ''),
				array( 	'name' => "Archivo Narrow",	 			'variant' => ':400,700'),
				array( 	'name' => "Arimo ",	 					'variant' => ':400,700'),
				array( 	'name' => "Arizonia",	 				'variant' => ''),
				array( 	'name' => "Armata ",	 				'variant' => ''),
				array( 	'name' => "Artifika ",	 				'variant' => ''),
				array( 	'name' => "Arvo ",	 					'variant' => ''),
				array( 	'name' => "Antic",	 					'variant' => ''),
				array( 	'name' => "Arvo",	 					'variant' => ':400,700'),
				array( 	'name' => "Asap",	 					'variant' => ':400,700'),
				array( 	'name' => "Asul",	 					'variant' => ':400,700'),
				array( 	'name' => "Atomic Age",	 				'variant' => ''),
				array( 	'name' => "Aubrey",	 					'variant' => ''),
				array( 	'name' => "Audiowide ",	 				'variant' => ''),
				array( 	'name' => "Autour One",	 				'variant' => ''),
				array( 	'name' => "Average",	 				'variant' => ''),
				array( 	'name' => "Average Sans",	 			'variant' => ''),
				array( 	'name' => "Averia Gruesa Libre",		'variant' => ''),
				array( 	'name' => "Averia Libre",				'variant' => ':400,700'),
				array( 	'name' => "Averia Sans Libre",			'variant' => ':400,700'),
				array( 	'name' => "Averia Serif Libre",			'variant' => ':400,700'),
				
				array( 	'name' => "Bad Script",	 				'variant' => ''),
				array( 	'name' => "Balthazar",	 				'variant' => ''),
				array( 	'name' => "Bangers",	 				'variant' => ''),
				array( 	'name' => "Basic",	 					'variant' => ''),
				array( 	'name' => "Baumans",	 				'variant' => ''),
				array( 	'name' => "Belgrano",	 				'variant' => ''),
				array( 	'name' => "Belleza",	 				'variant' => ''),
				array( 	'name' => "BenchNine",	 				'variant' => ':400,700'),
				array( 	'name' => "Bentham",	 				'variant' => ''),
				array( 	'name' => "Berkshire Swash",			'variant' => ''),
				array( 	'name' => "Bevan",	 					'variant' => ''),
				array( 	'name' => "Bigelow Rules",	 			'variant' => ''),
				array( 	'name' => "Bilbo",	 					'variant' => ''),
				array( 	'name' => "Bilbo Swash Caps",			'variant' => ''),
				array( 	'name' => "Bitter",	 					'variant' => ':400,700'),
				array( 	'name' => "Bonbon",	 					'variant' => ''),
				array( 	'name' => "Boogaloo",	 				'variant' => ''),
				array( 	'name' => "Bowlby One",	 				'variant' => ''),
				array( 	'name' => "Brawler",	 				'variant' => ''),
				array( 	'name' => "Bree Serif",	 				'variant' => ''),
				array( 	'name' => "Bubblegum Sans",	 			'variant' => ''),
				array( 	'name' => "Buda",	 					'variant' => ''),	
				array( 	'name' => "Buenard",	 				'variant' => ':400,700'),
				array( 	'name' => "Butterfly Kids",	 			'variant' => ''),
				
				array( 	'name' => "Cabin",	 					'variant' => ':400,600'),
				array( 	'name' => "Cabin Condensed",	 		'variant' => ':400,600'),				
				array( 	'name' => "Cagliostro",	 				'variant' => ''),
				array( 	'name' => "Calligraffitti",	 			'variant' => ''),
				array( 	'name' => "Cambo",	 					'variant' => ''),
				array( 	'name' => "Candal",	 					'variant' => ''),
				array( 	'name' => "Cantarell",	 				'variant' => ':400,700'),
				array( 	'name' => "Cantata One",	 			'variant' => ''),
				array( 	'name' => "Cantora One",	 			'variant' => ''),
				array( 	'name' => "Capriola",	 				'variant' => ''),
				array( 	'name' => "Cardo",	 					'variant' => ':400,700'),
				array( 	'name' => "Carme",	 					'variant' => ''),
				array( 	'name' => "Carrois Gothic",	 			'variant' => ''),
				array( 	'name' => "Carrois Gothic SC",			'variant' => ''),
				array( 	'name' => "Carter One",	 				'variant' => ''),
				array( 	'name' => "Caudex",	 					'variant' => ':400,700'),
				array( 	'name' => "Cedarville Cursive",			'variant' => ''),
				array( 	'name' => "Ceviche One",	 			'variant' => ''),
				array( 	'name' => "Changa One",	 				'variant' => ':400'),
				array( 	'name' => "Chau Philomene One",			'variant' => ':400'),
				array( 	'name' => "Chela One",	 				'variant' => ''),
				array( 	'name' => "Chelsea Market",	 			'variant' => ''),
				array( 	'name' => "Cherry Cream Soda ",			'variant' => ''),
				array( 	'name' => "Cherry Swash",	 			'variant' => ':400,700'),
				array( 	'name' => "Chewy",	 					'variant' => ''),
				array( 	'name' => "Chicle",	 					'variant' => ''),
				array( 	'name' => "Chivo",	 					'variant' => ':400,900'),
				array( 	'name' => "Cinzel",	 					'variant' => ':400,700'),
				array( 	'name' => "Cinzel Decorative",	 		'variant' => ':400,700'),				
				array( 	'name' => "Clicker Script",	 			'variant' => ''),
				array( 	'name' => "Coda",	 					'variant' => ':400,800'),
				array( 	'name' => "Coda Caption",	 			'variant' => ''),
				array( 	'name' => "Codystar",	 				'variant' => ':300,400'),
				array( 	'name' => "Combo",	 					'variant' => ''),
				array( 	'name' => "Comfortaa",	 				'variant' => ':400,700'),
				array( 	'name' => "Coming Soon",	 			'variant' => ''),
				array( 	'name' => "Concert One",	 			'variant' => ''),
				array( 	'name' => "Condiment",	 				'variant' => ''),
				array( 	'name' => "Contrail One",				'variant' => ''),
				array( 	'name' => "Convergence",	 			'variant' => ''),
				array( 	'name' => "Cookie",	 					'variant' => ''),
				array( 	'name' => "Copse",	 					'variant' => ''),
				array( 	'name' => "Corben",	 					'variant' => ':400,700'),
				array( 	'name' => "Courgette",	 				'variant' => ''),
				array( 	'name' => "Cousine",	 				'variant' => ':400,700'),
				array( 	'name' => "Coustard",	 				'variant' => ':400,900'),
				array( 	'name' => "Covered By Your Grace",		'variant' => ''),
				array( 	'name' => "Crafty Girls",	 			'variant' => ''),
				array( 	'name' => "Creepster",	 				'variant' => ''),
				array( 	'name' => "Crete Round",	 			'variant' => ':400'),
				array( 	'name' => "Crimson Text",	 			'variant' => ':400'),
				array( 	'name' => "Croissant One",	 			'variant' => ''),
				array( 	'name' => "Crushed",	 				'variant' => ''),
				array( 	'name' => "Cuprum",	 					'variant' => ':400,700'),
				array( 	'name' => "Cutive",	 					'variant' => ''),
				array( 	'name' => "Cutive Mono",				'variant' => ''),
				
				array( 	'name' => "Damion",	 					'variant' => ''),
				array( 	'name' => "Dancing Script",	 			'variant' => ':400,700'),
				array( 	'name' => "Dawning of a New Day",		'variant' => ''),
				array( 	'name' => "Days One",					'variant' => ''),
				array( 	'name' => "Delius",						'variant' => ''),
				array( 	'name' => "Delius Swash Caps",			'variant' => ''),
				array( 	'name' => "Delius Unicase",				'variant' => ':400,700'),
				array( 	'name' => "Della Respira",				'variant' => ''),
				array( 	'name' => "Denk One",					'variant' => ''),
				array( 	'name' => "Devonshire",					'variant' => ''),
				array( 	'name' => "Didact Gothic",				'variant' => ''),
				array( 	'name' => "Diplomata",					'variant' => ''),
				array( 	'name' => "Diplomata SC",				'variant' => ''),
				array( 	'name' => "Domine",						'variant' => ':400,700'),
				array( 	'name' => "Donegal One",				'variant' => ''),
				array( 	'name' => "Doppio One",					'variant' => ''),
				array( 	'name' => "Dorsa ",						'variant' => ''),
				array( 	'name' => "Dosis",						'variant' => ':400,700'),		
				array( 	'name' => "Dr Sugiyama",				'variant' => ''),
				array( 	'name' => "Droid Sans",					'variant' => ''),
				array( 	'name' => "Droid Sans Mono",			'variant' => ''),
				array( 	'name' => "Droid Serif",				'variant' => ':400,700'),
				array( 	'name' => "Duru Sans",					'variant' => ''),
				array( 	'name' => "Dynalight",					'variant' => ''),
				
				array( 	'name' => "EB Garamond",				'variant' => ''),
				array( 	'name' => "Eagle Lake",					'variant' => ''),
				array( 	'name' => "Eater",						'variant' => ''),
				array( 	'name' => "Economica",					'variant' => ':400,700'),
				array( 	'name' => "Electrolize",				'variant' => ''),
				array( 	'name' => "Elsie",						'variant' => ':400,900'),
				array( 	'name' => "Elsie Swash Caps",			'variant' => ':400,900'),
				array( 	'name' => "Emblema One",				'variant' => ''),
				array( 	'name' => "Emilys Candy",				'variant' => ''),
				array( 	'name' => "Engagement ",				'variant' => ''),
				array( 	'name' => "Englebert",					'variant' => ''),
				array( 	'name' => "Enriqueta",					'variant' => ':400,700'),
				array( 	'name' => "Erica One",					'variant' => ''),
				array( 	'name' => "Esteban",					'variant' => ''),
				array( 	'name' => "Euphoria Script",			'variant' => ''),
				array( 	'name' => "Ewert",						'variant' => ''),
				array( 	'name' => "Exo",						'variant' => ''),
				array( 	'name' => "Expletus Sans",				'variant' => ':400,700'),
				
				array( 	'name' => "Fanwood Text",				'variant' => ':400'),
				array( 	'name' => "Fascinate",					'variant' => ''),
				array( 	'name' => "Fascinate Inline",			'variant' => ''),
				array( 	'name' => "Faster One",					'variant' => ''),
				array( 	'name' => "Federant",					'variant' => ''),
				array( 	'name' => "Fjalla One",					'variant' => ''),
				array( 	'name' => "Felipa",						'variant' => ''),
				array( 	'name' => "Fjord One",					'variant' => ''),
				array( 	'name' => "Flamenco",					'variant' => ':300,400'),
				array( 	'name' => "Flavors",					'variant' => ''),
				array( 	'name' => "Fondamento",					'variant' => ':400'),
				array( 	'name' => "Fontdiner Swanky",			'variant' => ''),
				array( 	'name' => "Forum ",						'variant' => ''),
				array( 	'name' => "Francois One",				'variant' => ''),
				array( 	'name' => "Freckle Face",				'variant' => ''),
				array( 	'name' => "Fredericka the Great",		'variant' => ''),
				array( 	'name' => "Fredoka One",				'variant' => ''),
				array( 	'name' => "Fresca",						'variant' => ''),
				array( 	'name' => "Frijole",					'variant' => ''),
				array( 	'name' => "Fruktur",					'variant' => ''),
				array( 	'name' => "Fugaz One",					'variant' => ''),

				array( 	'name' => "Gafata",						'variant' => ''),
				array( 	'name' => "Galdeano",					'variant' => ''),
				array( 	'name' => "Gentium Basic",				'variant' => ':400,700'),
				array( 	'name' => "Galdeano",					'variant' => ''),
				array( 	'name' => "Gentium Basic",				'variant' => ':400,700'),
				array( 	'name' => "Gentium Book Basic",			'variant' => ''),
				array( 	'name' => "Geo",						'variant' => ':400'),
				array( 	'name' => "Germania One",				'variant' => ''),
				array( 	'name' => "Gilda Display",				'variant' => ''),
				array( 	'name' => "Give You Glory",				'variant' => ''),			
				array( 	'name' => "Glass Antiqua",				'variant' => ''),
				array( 	'name' => "Glegoo",						'variant' => ''),
				array( 	'name' => "Gloria Hallelujah",			'variant' => ''),
				array( 	'name' => "Goudy Bookletter 1911",		'variant' => ''),
				array( 	'name' => "Graduate",					'variant' => ''),
				array( 	'name' => "Grand Hotel",				'variant' => ''),
				array( 	'name' => "Gravitas One",				'variant' => ''),
				array( 	'name' => "Great Vibes",				'variant' => ''),
				array( 	'name' => "Griffy",						'variant' => ''),				
				array( 	'name' => "Gruppo",						'variant' => ''),
				array( 	'name' => "Gudea",						'variant' => ':400,700'),

				array( 	'name' => "Habibi",						'variant' => ''),
				array( 	'name' => "Hammersmith One",			'variant' => ''),
				array( 	'name' => "Handlee",					'variant' => ''),				 
				array( 	'name' => "Happy Monkey",				'variant' => ''),
				array( 	'name' => "Headland One",				'variant' => ''),
				array( 	'name' => "Henny Penny",				'variant' => ''),
				array( 	'name' => "Homenaje",					'variant' => ''),
				
				array( 	'name' => "IM Fell DW Pica",			'variant' => ':400'),
				array( 	'name' => "IM Fell Double Pica",		'variant' => ':400'),
				array( 	'name' => "IM Fell English",			'variant' => ':400'),
				array( 	'name' => "IM Fell French Canon",		'variant' => ':400'),
				array( 	'name' => "IM Fell Great Primer",		'variant' => ':400'),				
				array( 	'name' => "Iceberg",					'variant' => ''),
				array( 	'name' => "Iceland",					'variant' => ''),
				array( 	'name' => "Imprima",					'variant' => ''),
				array( 	'name' => "Inconsolata",				'variant' => ':400,700'),
				array( 	'name' => "Inder",						'variant' => ''),
				array( 	'name' => "Indie Flower",				'variant' => ''),
				array( 	'name' => "Inika",						'variant' => ':400,700'),
				array( 	'name' => "Irish Grover",				'variant' => ':400,700'),								
				array( 	'name' => "Istok Web",					'variant' => ':400,700'),
				array( 	'name' => "Italiana",					'variant' => ''),			
				array( 	'name' => "Italianno",					'variant' => ''),

				array( 	'name' => "Jacques Francois",			'variant' => ''),
				array( 	'name' => "Jacques Francois Shadow",	'variant' => ''),
				array( 	'name' => "Jim Nightshade",				'variant' => ''),				
				array( 	'name' => "Jockey One",					'variant' => ''),
				array( 	'name' => "Jolly Lodger",				'variant' => ''),
				array( 	'name' => "Josefin Sans",				'variant' => ':400,600,700'),
				array( 	'name' => "Josefin Slab",				'variant' => ''),
				array( 	'name' => "Joti One",					'variant' => ''),							
				array( 	'name' => "Judson",						'variant' => ':400,700'),
				array( 	'name' => "Julee",						'variant' => ''),	
				array( 	'name' => "Julius Sans One",			'variant' => ''),							
				array( 	'name' => "Junge",						'variant' => ''),
				array( 	'name' => "Jura",						'variant' => ''),
				array( 	'name' => "Just Another Hand",			'variant' => ''),
				array( 	'name' => "Just Me Again Down Here",	'variant' => ''),

				array( 	'name' => "Kameron",					'variant' => ':400,700'),
				array( 	'name' => "Karla",						'variant' => ':400,700'),
				array( 	'name' => "Kaushan Script",				'variant' => ''),
				array( 	'name' => "Kavoon",						'variant' => ''),
				array( 	'name' => "Keania One",					'variant' => ''),
				array( 	'name' => "Kelly Slab",					'variant' => ''),
				array( 	'name' => "Kenia",						'variant' => ''),				
				array( 	'name' => "Kite One",					'variant' => ''),
				array( 	'name' => "Knewave",					'variant' => ''),				
				array( 	'name' => "Kotta One",					'variant' => ''),
				array( 	'name' => "Kreon",						'variant' => ':400,700'),
				array( 	'name' => "Kristi",						'variant' => ''),
				array( 	'name' => "Krona One",					'variant' => ''),				

				array( 	'name' => "Lancelot",					'variant' => ''),
				array( 	'name' => "Lato",						'variant' => ':400,300,700,900,400italic,700italic,900italic'),
				array( 	'name' => "Ledger",						'variant' => ''),
				array( 	'name' => "Lekton",						'variant' => ':400,700'),
				array( 	'name' => "Libre Baskerville",			'variant' => ':400,700'),
				array( 	'name' => "Life Savers",				'variant' => ':400,700'),
				array( 	'name' => "Lilita One",					'variant' => ''),
				array( 	'name' => "Limelight",					'variant' => ''),
				array( 	'name' => "Linden Hill",				'variant' => ':400'),
				array( 	'name' => "Lobster",					'variant' => ''),				
				array( 	'name' => "Lobster Two",				'variant' => ':400,700'),
				array( 	'name' => "Londrina Solid",				'variant' => ''),
				array( 	'name' => "Lora",						'variant' => ''),
				array( 	'name' => "Love Ya Like A Sister",		'variant' => ''),
				array( 	'name' => "Loved by the King",			'variant' => ''),							
				array( 	'name' => "Lovers Quarrel",				'variant' => ''),
				array( 	'name' => "Luckiest Guy",				'variant' => ''),
				array( 	'name' => "Lusitana",					'variant' => ':400,700'),
				array( 	'name' => "Lustria",					'variant' => ''),

				array( 	'name' => "Macondo",					'variant' => ''),
				array( 	'name' => "Magra",						'variant' => ':400,700'),
				array( 	'name' => "Maiden Orange",				'variant' => ''),
				array( 	'name' => "Mako",						'variant' => ''),
				array( 	'name' => "Marcellus",					'variant' => ''),
				array( 	'name' => "Marck Script",				'variant' => ''),
				array( 	'name' => "Margarine",					'variant' => ''),
				array( 	'name' => "Marko One",					'variant' => ''),
				array( 	'name' => "Marmelad",					'variant' => ''),
				array( 	'name' => "Marvel",						'variant' => ':400,700'),
				array( 	'name' => "Mate",						'variant' => ':400'),
				array( 	'name' => "Maven Pro",					'variant' => ':400,700'),
				array( 	'name' => "McLaren",					'variant' => ''),
				array( 	'name' => "Meddon",						'variant' => ''),
				array( 	'name' => "Medula One",					'variant' => ''),
				array( 	'name' => "Meie Script",				'variant' => ''),
				array( 	'name' => "Merienda",					'variant' => ':400,700'),
				array( 	'name' => "Merienda One",				'variant' => ''),
				array( 	'name' => "Merriweather",				'variant' => ':400,700'),
				array( 	'name' => "Metal Mania",				'variant' => ''),
				array( 	'name' => "Metamorphous",				'variant' => ''),
				array( 	'name' => "Metrophobic ",				'variant' => ''),
				array( 	'name' => "Michroma",					'variant' => ''),
				array( 	'name' => "Milonga",					'variant' => ''),
				array( 	'name' => "Miltonian Tattoo",			'variant' => ''),
				array( 	'name' => "Miniver",					'variant' => ''), 
				array( 	'name' => "Modern Antiqua",				'variant' => ''),
				array( 	'name' => "Molengo",					'variant' => ''),
				array( 	'name' => "Molle",						'variant' => ':400italic'),
				array( 	'name' => "Monda",						'variant' => ':400,700'),
				array( 	'name' => "Montaga",					'variant' => ''),
				array( 	'name' => "Montez",						'variant' => ''),
				array( 	'name' => "Montserrat",					'variant' => ':400,700'),
				array( 	'name' => "Mouse Memoirs",				'variant' => ':400,700'),				
				array( 	'name' => "Mr Bedfort",					'variant' => ''),
				array( 	'name' => "Mr Dafoe",					'variant' => ''),
				array( 	'name' => "Mr De Haviland",				'variant' => ''),
				array( 	'name' => "Mrs Saint Delafield",		'variant' => ''),
				array( 	'name' => "Muli",						'variant' => ':300,400'),
				array( 	'name' => "Mystery Quest",				'variant' => ''),
				
				array( 	'name' => "Neucha",						'variant' => ''),
				array( 	'name' => "Neuton",						'variant' => ':400,700'),
				array( 	'name' => "New Rocker",					'variant' => ''),
				array( 	'name' => "News Cycle",					'variant' => ':400,700'),
				array( 	'name' => "Niconne",					'variant' => ''),
				array( 	'name' => "Nobile",						'variant' => ''),
				array( 	'name' => "Norican",					'variant' => ''),
				array( 	'name' => "Nothing You Could Do",		'variant' => ''),
				array( 	'name' => "Noticia Text",				'variant' => ':400,700'),
				array( 	'name' => "Nova Cut",					'variant' => ''),
				array( 	'name' => "Nova Flat",					'variant' => ''),
				array( 	'name' => "Nova Mono",					'variant' => ''),
				array( 	'name' => "Nova Round",					'variant' => ''),
				array( 	'name' => "Nova Slim",					'variant' => ''),
				array( 	'name' => "Nova Square",				'variant' => ''),
				array( 	'name' => "Numans",						'variant' => ''),
				array( 	'name' => "Nunito",						'variant' => ':300,400,700'),
				array( 	'name' => "Numans",						'variant' => ''),
				array( 	'name' => "Nunito",						'variant' => ':300,400,700'),

				array( 	'name' => "Offside",					'variant' => ''),
				array( 	'name' => "Old Standard TT",			'variant' => ':400,700'),
				array( 	'name' => "Oldenburg",					'variant' => ''),
				array( 	'name' => "Oleo Script",				'variant' => ':400,700'),
				array( 	'name' => "Open Sans",					'variant' => ':300,400,700'),
				array( 	'name' => "Open Sans Condensed",		'variant' => ':300,700'),
				array( 	'name' => "Oranienbaum",				'variant' => ''),
				array( 	'name' => "Orbitron",					'variant' => ':400,700'),
				array( 	'name' => "Oregano",					'variant' => ':400'),
				array( 	'name' => "Orienta",					'variant' => ''),
				array( 	'name' => "Original Surfer",			'variant' => ''),
				array( 	'name' => "Oswald",						'variant' => ':300,400,700'),
				array( 	'name' => "Overlock",					'variant' => ':400,700,900'),
				array( 	'name' => "Ovo",						'variant' => ''),
				array( 	'name' => "Oxygen",						'variant' => ':300,400,700'),
				array( 	'name' => "Oxygen Mono",				'variant' => ''),

				array( 	'name' => "PT Mono",					'variant' => ''),
				array( 	'name' => "PT Sans",					'variant' => ':400,700'),
				array( 	'name' => "PT Sans Narrow",				'variant' => ':400,700'),
				array( 	'name' => "PT Serif",					'variant' => ':400,700'),
				array( 	'name' => "PT Serif Caption",			'variant' => ':400'),
				array( 	'name' => "Pacifico",					'variant' => ''),
				array( 	'name' => "Paprika",					'variant' => ''),
				array( 	'name' => "Parisienne",					'variant' => ''),
				array( 	'name' => "Passero One",				'variant' => ''),	
				array( 	'name' => "Passion One",				'variant' => ':400'),
				array( 	'name' => "Patrick Hand",				'variant' => ''),
				array( 	'name' => "Patua One",					'variant' => ''),	
				array( 	'name' => "Paytone One",				'variant' => ''),
				array( 	'name' => "Peralta",					'variant' => ''),
				array( 	'name' => "Permanent Marker",			'variant' => ''),
				array( 	'name' => "Petit Formal Script",		'variant' => ''),
				array( 	'name' => "Petrona",					'variant' => ''),
				array( 	'name' => "Philosopher",				'variant' => ':400,700'),
				array( 	'name' => "Pinyon Script",				'variant' => ''),
				array( 	'name' => "Pirata One",					'variant' => ''),
				array( 	'name' => "Play",						'variant' => ':400,700'),
				array( 	'name' => "Playball",					'variant' => ''),
				array( 	'name' => "Playfair Display",			'variant' => ':400,700'),
				array( 	'name' => "Podkova",					'variant' => ''),
				array( 	'name' => "Poiret One",					'variant' => ''),
				array( 	'name' => "Poly",						'variant' => ':400'),
				array( 	'name' => "Pompiere",					'variant' => ''),
				array( 	'name' => "Pontano Sans",				'variant' => ''),
				array( 	'name' => "Port Lligat Sans",			'variant' => ''),
				array( 	'name' => "Port Lligat Slab",			'variant' => ''),
				array( 	'name' => "Princess Sofia",				'variant' => ''),
				array( 	'name' => "Prociono",					'variant' => ''),
				array( 	'name' => "Prosto One",					'variant' => ''),
				array( 	'name' => "Puritan",					'variant' => ':400,700'),
				array( 	'name' => "Purple Purse",				'variant' => ''),

				array( 	'name' => "Quando",						'variant' => ''),
				array( 	'name' => "Quantico",					'variant' => ':400,700'),
				array( 	'name' => "Quattrocento",				'variant' => ':400,700'),
				array( 	'name' => "Quattrocento Sans",			'variant' => ':400,700'),
				array( 	'name' => "Questrial",					'variant' => ''),
				array( 	'name' => "Quicksand",					'variant' => ':300,400,700'),
				array( 	'name' => "Quintessential",				'variant' => ''),
				array( 	'name' => "Qwigley",					'variant' => ''),

				array( 	'name' => "Radley",						'variant' => ''),
				array( 	'name' => "Raleway",					'variant' => ':300,400,500,600,700'),
				array( 	'name' => "Rambla",						'variant' => ':400,700'),
				array( 	'name' => "Ranchers",					'variant' => ''),
				array( 	'name' => "Rancho",						'variant' => ''),
				array( 	'name' => "Rationale",					'variant' => ''),
				array( 	'name' => "Redressed",					'variant' => ''),
				array( 	'name' => "Revalia",					'variant' => ''),
				array( 	'name' => "Righteous",					'variant' => ''),
				array( 	'name' => "Roboto",						'variant' => ':400,500,700'),
				array( 	'name' => "Roboto Slab",				'variant' => ':400,700'),
				array( 	'name' => "Roboto Condensed",			'variant' => ':300,400,700'),
				array( 	'name' => "Rochester",					'variant' => ''),
				array( 	'name' => "Rokkitt",					'variant' => ':400,700'),
				array( 	'name' => "Romanesco",					'variant' => ''),
				array( 	'name' => "Ropa Sans",					'variant' => ':400'),				
				array( 	'name' => "Rosario",					'variant' => ''),
				array( 	'name' => "Rosarivo",					'variant' => ':400'),
				array( 	'name' => "Rouge Script",				'variant' => ''),
				array( 	'name' => "Rouge Script",				'variant' => ':400'),
				array( 	'name' => "Ruda",						'variant' => ':400,700,900'),
				array( 	'name' => "Rufina",						'variant' => ''),
				array( 	'name' => "Ruluko",						'variant' => ''),
				array( 	'name' => "Rum Raisin",					'variant' => ''),
				array( 	'name' => "Russo One",					'variant' => ''),
				array( 	'name' => "Ruthie",						'variant' => ''),

				array( 	'name' => "Sacramento",					'variant' => ''),
				array( 	'name' => "Sail",						'variant' => ''),
				array( 	'name' => "Salsa",						'variant' => ''),
				array( 	'name' => "Sanchez",					'variant' => ':400'),
				array( 	'name' => "Sansita One",				'variant' => ''),
				array( 	'name' => "Satisfy",					'variant' => ''),
				array( 	'name' => "Scada",						'variant' => ':400,700'),
				array( 	'name' => "Schoolbell",					'variant' => ''),
				array( 	'name' => "Seaweed Script",				'variant' => ''),
				array( 	'name' => "Shadows Into Light",			'variant' => ''),
				array( 	'name' => "Shadows Into Light Two",		'variant' => ''),
				array( 	'name' => "Shanti",						'variant' => ''),
				array( 	'name' => "Share",						'variant' => ':400,700'),
				array( 	'name' => "Share Tech Mono",			'variant' => ''),
				array( 	'name' => "Short Stack",				'variant' => ''),
				array( 	'name' => "Signika",					'variant' => ':300,400,600'),
				array( 	'name' => "Signika Negative",			'variant' => ':300,400,600,700'),
				array( 	'name' => "Simonetta",					'variant' => ':400,900'),
				array( 	'name' => "Six Caps",					'variant' => ''),
				array( 	'name' => "Skranji",					'variant' => ':400,700'),
				array( 	'name' => "Smythe",						'variant' => ''),
				array( 	'name' => "Snippet",					'variant' => ''),
				array( 	'name' => "Snowburst One",				'variant' => ''),
				array( 	'name' => "Sofadi One",					'variant' => ''),
				array( 	'name' => "Sofia",						'variant' => ''),
				array( 	'name' => "Sorts Mill Goudy",			'variant' => ':400'),
				array( 	'name' => "Source Code Pro",			'variant' => ':400,600,700'),
				array( 	'name' => "Source Sans Pro",			'variant' => ':400,600,700'),
				array( 	'name' => "Special Elite",				'variant' => ''),
				array( 	'name' => "Spinnaker",					'variant' => ''),
				array( 	'name' => "Spirax",						'variant' => ''),
				array( 	'name' => "Stint Ultra Condensed",		'variant' => ''),
				array( 	'name' => "Stint Ultra Expanded",		'variant' => ''),
				array( 	'name' => "Stoke",						'variant' => ':300,400'),
				array( 	'name' => "Strait",						'variant' => ''),
				array( 	'name' => "Syncopate",					'variant' => ''),

				array( 	'name' => "Tangerine",					'variant' => ':400,700'),
				array( 	'name' => "Telex",						'variant' => ''),
				array( 	'name' => "Tenor Sans",					'variant' => ''),
				array( 	'name' => "Tienne",						'variant' => ':400,700'),
				array( 	'name' => "Tinos",						'variant' => ':400,700'),
				array( 	'name' => "Titillium Web",				'variant' => ':400,600,700'),
				array( 	'name' => "Trocchi",					'variant' => ''),
				array( 	'name' => "Trochut",					'variant' => ':400,700'),
				array( 	'name' => "Trykker",					'variant' => ''),
				array( 	'name' => "Tulpen One",					'variant' => ''),

				array( 	'name' => "Ubuntu",						'variant' => ':400,500,700'),
				array( 	'name' => "Ubuntu Condensed",			'variant' => ''),				
				array( 	'name' => "Ubuntu Mono",				'variant' => ':400,700'),
				array( 	'name' => "Unica One",					'variant' => ''),
				array( 	'name' => "Unkempt",					'variant' => ''),
				array( 	'name' => "Unna",						'variant' => ''),

				array( 	'name' => "Varela",						'variant' => ''),
				array( 	'name' => "Varela Round",				'variant' => ''),
				array( 	'name' => "Vibur",						'variant' => ''),
				array( 	'name' => "Vidaloka",					'variant' => ''),
				array( 	'name' => "Voces",						'variant' => ''),
				array( 	'name' => "Volkhov",					'variant' => ':400,700'),
				array( 	'name' => "Vollkorn",					'variant' => ':400,700'),
				array( 	'name' => "Voltaire",					'variant' => ''),

				array( 	'name' => "Walter Turncoat",			'variant' => ''),
				array( 	'name' => "Wellfleet",					'variant' => ''),
				array( 	'name' => "Wendy One",					'variant' => ''),
				array( 	'name' => "Wire One",					'variant' => ''),

				array( 	'name' => "Yanone Kaffeesatz",			'variant' => ''),
				array( 	'name' => "Yellowtail",					'variant' => ''),				
				array( 	'name' => "Yeseva One",					'variant' => ''),
				array( 	'name' => "Yesteryear",					'variant' => ''),


		
			);
			$fonts = '';
			// Go through the font options
			if ( !empty($iva_of_options) ) {
				foreach ( $iva_of_options as $key => $option ) {
					$option_types = $option['type'];
					if($option_types == "atpfontfamily"){ 
						foreach ($google_fonts as $font) {
							$googlefont = get_option($option['id']);

							if ( $googlefont == $font['name'] AND !strstr($fonts, $font['name'])){
								$fonts .= $font['name'].$font['variant']."|";
							}
						}
					}
				}	
			}

			// Output google font css in header
			if( ! is_admin() ) {
				if ( $fonts ) {
					$fonts = str_replace( " ","+",$fonts);	
					$protocol = (is_ssl()) ? 'https://' : 'http://';

					$out = "\n<!-- Google Fonts -->\n";
					$out .= '<link href="'.$protocol.'fonts.googleapis.com/css?family=' . $fonts .'" rel="stylesheet" type="text/css" />'."\n\n";
					echo str_replace( '|','%7C',$out);
				}
			}
			return $google_fonts;
		}
	}

?>
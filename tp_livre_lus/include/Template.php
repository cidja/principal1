<?php

/**
 * Gère le système de template
 * C'est un système très léger n'autorisant aucune modification des variables, juste leur affichage et des scructures conditionelles de types que if|elseif|else
 *
 * @author Ariel
 */
class Template
{

	const PATTERN_ECHO				 = '#\{((\$[A-Za-z_][A-Za-z0-9_]*)(\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*)\}#si';
	const REPLACE_ECHO				 = '<?php echo isset( $1 ) ? $1 : "";?>';
	const PATTERN_IF					 = '#\{if\s*((\!)*(\$[A-Za-z_][A-Za-z0-9_]*)(\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*)\s*(((&&|\|\|)?\s*(((\!)*(\$[A-Za-z_][A-Za-z0-9_]*)(\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*)\s*)*|((==|<|>|<=|>=|\!=|%)\s*(([\'"]*[^\'"\{\}]*[\'"]*)|(((\$[A-Za-z_][A-Za-z0-9_]*)(\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*))))*)*)\}#si';
	const REPLACE_IF					 = '<?php if($1 $5){ ?>';
	const PATTERN_ELSEIF				 = '#\{elseif\s*((\!)*(\$[A-Za-z_][A-Za-z0-9_]*)(\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*)\s*(((&&|\|\|)?\s*(((\!)*(\$[A-Za-z_][A-Za-z0-9_]*)(\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*)\s*)*|((==|<|>|<=|>=|\!=|%)\s*(([\'"]*[^\'"\{\}]*[\'"]*)|(((\$[A-Za-z_][A-Za-z0-9_]*)(\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*))))*)*)\}#si';
	const REPLACE_ELSEIF				 = '<?php }elseif($1 $5){ ?>';
	const PATTERN_ELSE				 = '#\{else\}#si';
	const REPLACE_ELSE				 = '<?php }else{ ?>';
	const PATTERN_FIN_IF				 = '#\{/if\}#si';
	const REPLACE_FIN_IF				 = '<?php } ?>';
	const PATTERN_FOREACH				 = '#\{foreach\s*(\$[A-Za-z_][A-Za-z0-9_]*)((\[\s*\$*[\'"]*[A-Za-z0-9_]*[\'"]*\s*\])*)\s*as\s*(\$[A-Za-z_][A-Za-z0-9_]+)\s*(=>)*\s*(\$[A-Za-z_][A-Za-z0-9_]+)*\}#si';
	const REPLACE_FOREACH				 = '<?php if(isset($1$2) && is_array($1$2)){foreach($1$2 as $4 $5 $6){ ?>';
	const PATTERN_FIN_FOREACH			 = '#\{/foreach\}#si';
	const REPLACE_FIN_FOREACH			 = '<?php }}?>';
	const PATTERN_PHP_TAG_SPACE		 = '#([ \t]+)<\?php#';
	const REPLACE_PHP_TAG_SPACE		 = ' <?php';
	const PATTERN_FIN_PHP_TAG_SPACE	 = '#\?>([ \t]+)#';
	const REPLACE_FIN_PHP_TAG_SPACE	 = '?> ';
	const PATTERN_PHP_TAG_MERGE		 = '#\?>\s*<\?php#';
	const REPLACE_PHP_TAG_MERGE		 = ' echo " "; ';

	/**
	 * Chemin vers le dossier contenant les templates
	 *
	 * @var string
	 */
	private $_dossiertemplates = '';

	/**
	 * Document Root
	 *
	 * @var string
	 */
	private $_documentRoot = '';

	/**
	 * Chemin vers le dossier contenant les caches
	 *
	 * @var string
	 */
	private $_dossierCache = '';

	/**
	 * Chemin du fichier de template
	 *
	 * @var string
	 */
	private $_fichier = '';

	/**
	 * Tableau contenant les patterns à matcher
	 *
	 * @var array
	 */
	private $_arrPattern = array();

	/**
	 * Tableau contenant les remplacements de patterns
	 *
	 * @var array
	 */
	private $_arrReplace = array();

	/**
	 * Contient les variables assignées au template
	 *
	 * @var array
	 */
	private $_arrVariables = array();

	public function __construct($type = '')
	{
   
		$this->_dossiertemplates = dirname( dirname( __FILE__ ) ). '/templates/';
		$this->_dossierCache	 = dirname( dirname( __FILE__ ) ) . '/templates/cache/';
        $this->_arrPattern	 = array(
			Template::PATTERN_ECHO,
			Template::PATTERN_IF,
			Template::PATTERN_ELSEIF,
			Template::PATTERN_ELSE,
			Template::PATTERN_FIN_IF,
			Template::PATTERN_FOREACH,
			Template::PATTERN_FIN_FOREACH,
			Template::PATTERN_PHP_TAG_SPACE,
			Template::PATTERN_FIN_PHP_TAG_SPACE,
			Template::PATTERN_PHP_TAG_MERGE,
		);
		$this->_arrReplace	 = array(
			Template::REPLACE_ECHO,
			Template::REPLACE_IF,
			Template::REPLACE_ELSEIF,
			Template::REPLACE_ELSE,
			Template::REPLACE_FIN_IF,
			Template::REPLACE_FOREACH,
			Template::REPLACE_FIN_FOREACH,
			Template::REPLACE_PHP_TAG_SPACE,
			Template::REPLACE_FIN_PHP_TAG_SPACE,
			Template::REPLACE_PHP_TAG_MERGE,
		);

		/*
		 * Ajout des variables des includes
		 * Uniquement textes et nombres
		 */
		foreach( $GLOBALS as $nom => $valeur )
		{
			if( $nom == '_GET' || $nom == '_POST' || $nom == '_COOKIE' || $nom == '_FILES' || $nom == '_ENV' || $nom == '_REQUEST' || $nom == '_SERVER' || $nom == 'GLOBALS' || is_object( $valeur ) )
			{
				continue;
			}

			$this->setVar( $nom, $valeur );
		}
	}

	/*
	 *
	 * Getters
	 *
	 */

	/**
	 * Retourne le chemin vers le dossier contenants les templates
	 *
	 * @return string
	 */
	private function getDossierTemplates()
	{
		return $this->_dossiertemplates;
	}

	/**
	 * Retourne le chemin vers le dossier contenants les fichiers de cache
	 *
	 * @return string
	 */
	private function getdossierCache()
	{
		return $this->_dossierCache;
	}

	/**
	 * Retourne le chemin vers le fichier de template
	 *
	 * @return string
	 */
	private function getFichier()
	{
		return $this->_fichier;
	}

	/**
	 * Retourne le chemin vers le fichier de cache du template
	 *
	 * @return string
	 */
	private function getFichierCache()
	{
		return $this->getdossierCache() . md5( $this->getfichier() ) . '.php';
	}

	/**
	 * Retourne le tableau des patterns
	 * 
	 * @return array
	 */
	private function getPattern()
	{
		return $this->_arrPattern;
	}

	/**
	 * Retourne le tableau des replacements de patterns
	 * 
	 * @return array
	 */
	private function getReplace()
	{
		return $this->_arrReplace;
	}

	/**
	 * Retourne toutes les variables du template
	 * 
	 * @return array
	 */
	public function getToutesVars()
	{
		return $this->_arrVariables;
	}

	/**
	 * Retourne la valeur d'une variable du template
	 * 
	 * @param string $nom
	 * @return mixed
	 */
	private function getVar( $nom )
	{
		return $this->_arrVariables[ $nom ];
	}

	/**
	 * Permet de savoir si la variable existe
	 * 
	 * @param string $nom
	 * @return boolean
	 */
	private function varExiste( $nom )
	{
		return isset( $this->_arrVariables[ $nom ] );
	}

	/**
	 * Permet de savoir si le fichier de cache est toujours à jour
	 *
	 * @return boolean
	 */
	public function isCacheOk()
	{
		return file_exists( $this->getFichierCache() ) && filemtime( $this->getFichier() ) < filemtime( $this->getFichierCache() );
	}

	/**
	 * Affiche le template
	 */
	public function afficher( $fichier, $afficherNomTemplate = false )
	{
		$this->setFichier( $fichier );
		if( !file_exists( $this->getFichier() ) )
		{
			die( 'Le template ' . $fichier . " n'éxiste pas" );
		}

		if( !$this->isCacheOk() )
		{
			$this->reconstruireFichierCache();
		}

		$arrVars = $this->getToutesVars();

		foreach( $arrVars as $nom => $valeur )
		{
			${$nom} = $valeur;
		}

		if( $afficherNomTemplate )
		{
			echo '<!-- Généré par le Template ' . $fichier . ' -->';
		}

		include $this->getFichierCache();
	}

	public function stockerDansVariable( $fichier, $afficherNomTemplate = false )
	{
		ob_start();
		$this->afficher( $fichier, $afficherNomTemplate );

		$resultat = ob_get_contents();
		ob_end_clean();

		return $resultat;
	}

	/**
	 * Initialise le chemin vers le fichier de template
	 *
	 * @param string $fichier
	 */
	public function setFichier( $fichier )
	{
		$this->_fichier = $this->getDossierTemplates() . $fichier;
	}

	/**
	 * Assigne une variable au template
	 * 
	 * @param string $nom
	 * @param mixed $var
	 */
	public function setVar( $nom, $var )
	{
		$this->_arrVariables[ $nom ] = $var;
	}

	/**
	 * Reconstruit le fichier de cache
	 */
	public function reconstruireFichierCache()
	{
		$contenuTemplate = file_get_contents( $this->getFichier() );

		$contenuCache	 = preg_replace( $this->getPattern(), $this->getReplace(), $contenuTemplate );
		
		$fCache = fopen( $this->getFichierCache(), 'w+' );
		fwrite( $fCache, $contenuCache );
		fclose( $fCache );
	}

}

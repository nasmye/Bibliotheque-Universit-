# Bibliotheque d'Université

<h1 >La gestion de la bibliothèque :</h1>

<p>Notre modèle de gestion de bibliothèque est constitué de deux parties, la partie utilisateur « USER » et la partie administrateur « ADMIN » (figure01).</p> 
<ul>
	<li> <h2>1. Partie utilisateur :</h2>
		Dans la partie utilisateur, notre modèle permettra aux utilisateurs d'effectuer les opérations suivantes :
		<ul>
			 <h3>Explorer les documents : </h3>
			<li>N’importe quel visiteur peut voir les différentes catégories et domaines d’un document. </li>
			 <h3> Inscription/Connexion : </h3>
			<li>L’inscription est partiellement en ligne, d’abord l’utilisateur doit demander sa carte auprès du bibliothécaire. Ensuite, s’inscrire à l’application grâce au numéro de carte. Et finalement se connecter.</li>
			<h3>Gestion des réservations/emprunts :</h3>
			<li>Après la connexion, les membres peuvent établir des réservations de documents avec une durée limitée. Ensuite, ils doivent les confirmer auprès du bibliothécaire pour enfin disposer du produit.</li>
      <h3>Recherche : </h3>
      <li> 
				<ul>
					<li>a. Recherche par mot-clé :<br>
					L’utilisateur doit choisir le bon critère de recherche et doit entrer le terme de recherche adéquat. Les critères disponibles sont : TITRE / AUTEUR / ANNEE.
					S'il y a un résultat, le logiciel se positionne sur la page de résultat qui indique le nombre de réponses et affiche la liste des documents trouvés. Sinon, le logiciel renvoie le message : « Aucun document ne correspond à votre recherche ».</li>
					<li>b. Recherche avancée : <br>
					Si la première recherche n’a pas donné de résultats satisfaisants, on passe à la recherche avancée. Les critères disponibles sont : TITRE /AUTEUR /ANNEE /DOMAINE /CATEGORIE.
					On obtient des résultats spécifiés à la recherche.</li>
				</ul>
			</li>
			<h3> Déconnexion.</h3>
		</ul>
	</li>
	<li> <h2>2. Partie administrateur :</h2>
		Il est le responsable pour accomplir les tâches suivantes :
		<ul>
			<li> Ajouter une nouvelle carte d’utilisateur à la base de données, modifier les informations personnelles de l’utilisateur ou le supprimer. </li>
			<li> Ajouter un document, le modifier ou le supprimer. </li>
			<li> Gérer les réservations. </li>
			<li> Gérer les emprunts.</li>
		</ul>
	</li>
</ul>

<h1 > Présentation du projet :</h1>

<p>Afin de cerner les besoins des différents utilisateurs et administrateurs de la bibliothèque, nous avons effectué une étude pour dégager l’architecture générale de notre application ci-dessus :</p> 
<ul>
	<li> USER : Il peut être étudiant, enseignant ou employé. </li>
	<li> ADMIN : Représente un responsable dans la bibliothèque.</li>
	<li> BDD : La base de donnée des utilisateurs et des documents.</li>
	<li> Inscription : L’utilisateur doit demander sa carte auprès de l’administrateur (bibliothécaire).</li>
	<li> Mise à jour : L’utilisateur peut modifier ses renseignements.</li>
	<li> Demande Emprunt : si le document est disponible, l’utilisateur peut le réserver sinon son état peut être soit « pris », « réservé » ou « n’existe pas ».</li>
	<li> Annulation Réservation : l’utilisateur peut à tout moment annuler sa réservation.</li>
	<li> Ajouter/Supprimer Document : l’administrateur s’occupe de cette tâche.</li>
	<li> Mise à jour Document : l’administrateur peut modifier les caractéristiques d’un document comme modifier sa disponibilité et sa quantité en confirmant l’emprunt.</li>
	<li> Retourner un document : après que l’utilisateur rend le document emprunté, sa disponibilité et quantité reprend ses valeurs initiales.</li>

</ul>
<a href="https://zupimages.net/viewer.php?id=23/11/heie.png"><img src="https://zupimages.net/up/23/11/heie.png" alt="" /></a>

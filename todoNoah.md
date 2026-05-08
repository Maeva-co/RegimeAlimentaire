## L’application suggère les régimes et l’activité sportive nécessaire pendant une durée
- Donnees de test (User)
- Prendre l'objectif, l'IMC
- Choisir les sports et les regimes adequats aux choix (ce regime la pour cette duree la)
- Achat et diminution de la balance
    
## On peut rajouter de l’argent dans son porte monnaie en rentrant un code

- Init db [ok]
- Creation donnees de test [ok]
    - 1 user
    - 1 code avec valeur > 0

- Page pour redeem un code :
    - Input code 
    - Submit :
        - Verifier si code existe
        - Si code existe , augmenter balance
        - Sinon message erreur
    
Tables inclues : User (balance), Code

## L’utilisateur peut avoir une option Gold qu’il va payer en une  seule fois, à vous de proposer le prix et le mode d’accès

- Page d'achat d'offres (Options)
- Donnes pour l'instant : Option Gold (donnes a creer)
- Faire le choix d'Option
- Apres achat : ajout dans OptionUser
- Appliquer la reduction (a discuter)
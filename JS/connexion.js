const connexionButton = document.querySelector('.connexion-button')
const connexionDialog = document.querySelector('.connexion-dialog')
const createUserDialog = document.querySelector('.create-user')
const createUserButton = document.querySelector('.btn-creation')

connexionButton.addEventListener('click', () => {
  connexionDialog.showModal()
})

// Fermer le dialog lorsque l'utilisateur clique en dehors de celui-ci
connexionDialog.addEventListener('click', (event) => {
  if (event.target === connexionDialog) {
    connexionDialog.close()
  }
})

createUserButton.addEventListener('click', () => {
  createUserDialog.showModal()
})

// Fermer le dialog lorsque l'utilisateur clique en dehors de celui-ci
createUserDialog.addEventListener('click', (event) => {
  if (event.target === createUserDialog) {
    createUserDialog.close()
  }
})

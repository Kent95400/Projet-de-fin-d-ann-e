const panierButton = document.querySelector('.panier')
const panierDialog = document.querySelector('.panier-dialog')

panierButton.addEventListener('click', () => {
  panierDialog.showModal()
})

// Fermer le dialog lorsque l'utilisateur clique en dehors de celui-ci
panierDialog.addEventListener('click', (event) => {
  if (event.target === panierDialog) {
    panierDialog.close()
  }
})

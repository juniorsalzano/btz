document.addEventListener('DOMContentLoaded', function() {
  const zipCodeInput = document.getElementById('zip_code');
  if (zipCodeInput) {
    zipCodeInput.addEventListener('blur', function() {
      const cep = this.value.replace(/\D/g, '');
      if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
          .then(response => response.json())
          .then(data => {
            if (!data.erro) {
              document.getElementById('address').value = data.logradouro;
              document.getElementById('neighborhood').value = data.bairro;
              document.getElementById('city').value = data.localidade;
              document.getElementById('state').value = data.uf;
            } else {
              alert('CEP não encontrado.');
            }
          });
      }
    });
  }
});
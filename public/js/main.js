document.addEventListener('DOMContentLoaded', function() {
  const loadingOverlay = document.createElement('div');
  loadingOverlay.id = 'loading-overlay';
  loadingOverlay.innerHTML = '<div class="spinner"></div>';
  document.body.appendChild(loadingOverlay);

  function showLoading() {
    loadingOverlay.style.display = 'flex';
  }

  function hideLoading() {
    loadingOverlay.style.display = 'none';
  }

  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
      showLoading();
    });
  });

  window.addEventListener('beforeunload', showLoading);
  window.addEventListener('pageshow', hideLoading);
  window.addEventListener('load', hideLoading);
});
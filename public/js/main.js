document.addEventListener('DOMContentLoaded', function() {
  const loadingOverlay = document.createElement('div');
  loadingOverlay.id = 'loading-overlay';
  loadingOverlay.innerHTML = '<div class="spinner"></div>';
  document.body.appendChild(loadingOverlay);

  let loadingStartTime;

  function showLoading() {
    loadingStartTime = Date.now();
    loadingOverlay.style.display = 'flex';
  }

  function hideLoading() {
    const elapsedTime = Date.now() - loadingStartTime;
    const remainingTime = 3000 - elapsedTime; // 3000ms = 3 seconds
    setTimeout(() => {
      loadingOverlay.style.display = 'none';
    }, remainingTime > 0 ? remainingTime : 0);
  }

  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
      showLoading();
    });
  });

  window.addEventListener('beforeunload', showLoading);
  window.addEventListener('load', hideLoading);
});
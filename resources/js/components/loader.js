document.addEventListener('DOMContentLoaded', function() {
    // Show loader
    const loader = document.getElementById('loader-container');
    
    // Hide loader when page is fully loaded
    if (loader) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                loader.style.display = 'none';
            }, 1000);
        });
    }
});


// sayfa ilk yüklendiğinde kaydırma işlemi otomatik olarak yapılacak

// Sayfa yüklendiğinde çalışacak fonksiyon
document.addEventListener('DOMContentLoaded', function() {
  // Sayfanın yüklenmesini bekle ve sonra .start elementine git
  setTimeout(() => {
      scrollToStart();
  }, 100);
});

// .start elementine scroll yapan fonksiyon
function scrollToStart() {
  const startElement = document.querySelector('.start');
  if (startElement) {
      startElement.scrollIntoView({ 
          behavior: 'smooth',
          block: 'start'
      });
  }
}

// Genel scroll fonksiyonu
function go(selector) {
  const element = document.querySelector(selector);
  if (element) {
      element.scrollIntoView({ 
          behavior: 'smooth',
          block: 'start'
      });
  }
}

/* ========================================
   JAVASCRIPT PARA DROPDOWN DE USUARIO
   Agregar al final de main-admin.js o en un archivo separado
   ======================================== */

// Funcionalidad del dropdown de usuario
document.addEventListener('DOMContentLoaded', function() {
  const userMenuBtn = document.getElementById('userMenuBtn');
  const userDropdown = document.getElementById('userDropdown');
  
  // Crear overlay
  const overlay = document.createElement('div');
  overlay.className = 'dropdown-overlay';
  document.body.appendChild(overlay);
  
  // Toggle del dropdown
  if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      const isOpen = userDropdown.classList.contains('show');
      
      if (isOpen) {
        closeDropdown();
      } else {
        openDropdown();
      }
    });
    
    // Cerrar al hacer click en el overlay
    overlay.addEventListener('click', closeDropdown);
    
    // Cerrar con tecla Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && userDropdown.classList.contains('show')) {
        closeDropdown();
      }
    });
    
    // Prevenir cierre al hacer click dentro del dropdown
    userDropdown.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  }
  
  // Funciones auxiliares
  function openDropdown() {
    userDropdown.classList.add('show');
    overlay.classList.add('show');
    
    // Animación suave de los items
    const items = userDropdown.querySelectorAll('.dropdown-item');
    items.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateX(-10px)';
      setTimeout(() => {
        item.style.transition = 'all 0.2s ease';
        item.style.opacity = '1';
        item.style.transform = 'translateX(0)';
      }, 50 * index);
    });
  }
  
  function closeDropdown() {
    userDropdown.classList.remove('show');
    overlay.classList.remove('show');
  }
  
  // Funcionalidad del botón de cambiar tema
  const toggleThemeBtn = document.getElementById('toggleThemeBtn');
  if (toggleThemeBtn) {
    toggleThemeBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Aquí puedes implementar el cambio de tema
      document.body.classList.toggle('light-mode');
      
      // Cambiar icono según el modo
      const icon = this.querySelector('i:first-child');
      if (document.body.classList.contains('light-mode')) {
        icon.className = 'ri-sun-line';
      } else {
        icon.className = 'ri-contrast-2-line';
      }
      
      // Guardar preferencia en localStorage
      const currentMode = document.body.classList.contains('light-mode') ? 'light' : 'dark';
      localStorage.setItem('theme-mode', currentMode);
    });
  }
  
  // Cargar tema guardado al iniciar
  const savedTheme = localStorage.getItem('theme-mode');
  if (savedTheme === 'light') {
    document.body.classList.add('light-mode');
    const icon = toggleThemeBtn?.querySelector('i:first-child');
    if (icon) icon.className = 'ri-sun-line';
  }
  
  // Función para mostrar notificaciones (opcional)
  function showNotification(message) {
    // Crear elemento de notificación
    const notification = document.createElement('div');
    notification.className = 'toast-notification';
    notification.innerHTML = `
      <i class="ri-check-line"></i>
      <span>${message}</span>
    `;
    notification.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: #10b981;
      color: white;
      padding: 14px 20px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
      z-index: 10000;
      animation: slideInRight 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remover después de 3 segundos
    setTimeout(() => {
      notification.style.animation = 'slideOutRight 0.3s ease';
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  }
});

// Animaciones para las notificaciones
const style = document.createElement('style');
style.textContent = `
  @keyframes slideInRight {
    from {
      transform: translateX(100%);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }
  
  @keyframes slideOutRight {
    from {
      transform: translateX(0);
      opacity: 1;
    }
    to {
      transform: translateX(100%);
      opacity: 0;
    }
  }
  
  .toast-notification i {
    font-size: 20px;
  }
`;
document.head.appendChild(style);
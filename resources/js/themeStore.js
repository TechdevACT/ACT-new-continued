import { reactive } from 'vue';

export const themeStore = reactive({
  theme: 'light',

  initTheme() {
    const savedTheme = localStorage.getItem('theme');
    const userPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme) {
      this.theme = savedTheme;
    } else if (userPrefersDark) {
      this.theme = 'dark';
    } else {
      this.theme = 'light';
    }

    this.applyTheme();
  },

  toggleTheme() {
    this.theme = this.theme === 'light' ? 'dark' : 'light';
    this.applyTheme();
  },

  applyTheme() {
    localStorage.setItem('theme', this.theme);
    if (this.theme === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  }
});

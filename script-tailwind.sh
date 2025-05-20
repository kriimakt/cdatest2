echo "Téléchargement de tailwind"
curl -sLO https://github.com/tailwindlabs/tailwindcss/releases/download/v3.4.17/tailwindcss-windows-x64.exe
echo "activation"
chmod +x tailwindcss-windows-x64.exe
echo "deplacement"
mv tailwindcss-windows-x64.exe ./bin/tailwindcss
echo "Création du fichier de config"
./bin/tailwindcss init
echo "edition du fichier de config"
echo "/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    \"./assets/**/*.js\",
    \"./templates/**/*.html.twig\",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
">tailwind.config.js

echo "edition du fichier app.css"
echo "@tailwind base;
@tailwind components;
@tailwind utilities;">assets/styles/app.css
echo "création du fichier tailwind.css"
touch assets/styles/app.tailwind.css 
echo "Configuration app.js"
echo "import './bootstrap.js';
import './styles/app.css';
import './styles/app.tailwind.css';">assets/app.js

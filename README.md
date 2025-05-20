Pour récupérer le projet :

```sh
git clone https://github.com/evaluationWeb/symfonycdaexemple.git
```

se déplacer :
```sh
cd symfonycdaexemple
```

installer les dépendances :

```sh
composer install
```

installer tailwindcss :
```sh
bash script-tailwind.sh
```

paramètrer le fichier .env.dev :
```sh
DATABASE_URL="mysql://loginBDD:password@127.0.0.1:3306/nomBDD?serverVersion=10.4.32-MariaDB&charset=utf8mb4"
```

Créer la BDD
```sh
symfony console d:d:c
```

Si pas de fichiers de migration :
```sh
symfony console make:migration
```

Appliquer la migration 
```sh
symfony console d:m:m
```

Générer les fixtures :
```sh
symfony console d:f:l
```



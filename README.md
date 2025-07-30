Video

**Voici quelques prérequis pour pouvoir ouvrir en localhost le site :**
**Important :**  
```Etape 1``` va dans l'invite de commande et place toi dans le dossier dans lequel tu as mis les fichiers du site (pense à bien respecter les sous-dossiers), ensuite il faudra taper cette commande :
  ```C:\TON\CHEMIN\JUSQUE\PHP.EXE -S localhost:8000``` et normalement dans le navigateur il suffit de marquer dans la barre de recherche "localhost:8000" pour ouvrir le site.

---
  
Pour que tout fonctionne correctement, il faut bien retirer les points-virgules `;` devant extension_dir comme indiqué (dans le fichier de configuration `php.ini`) pour les activer, et ajouter le chemin où se trouvent les DLL (sur les images c'est mon chemin).  
![Image 4](https://github.com/Petpetdu51/video/blob/main/extension_dir1.png)  
![Image 5](https://github.com/Petpetdu51/video/blob/main/extension_dir2.png) 

![Image 6](https://github.com/Petpetdu51/video/blob/main/extension_dir3.png)

Voici un exemple de configuration illustré :  

![Configuration](https://github.com/Petpetdu51/video/blob/main/fichiers_dll.png)

---

N’hésite pas à consulter ce README pour comprendre comment configurer correctement ton environnement.

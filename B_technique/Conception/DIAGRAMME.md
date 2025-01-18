##conception tables basic
```pash
+-------------------+       +-------------------+       +-------------------+
|   Utilisateur     |       |     Document      |       |    Ressource      |
|-------------------|       |-------------------|       |-------------------|
| +id: Int          |       | +id: Int          |       | +id: Int          |
| +nom: String      |       | +titre: String    |       | +nom: String      |
| +email: String    |       | +chemin_fichier:  |       | +type: String     |
| +role: String     |       |   String          |       | +description:     |
| +created_at:      |       | +date_telechargem |       |   String          |
|   timestamp       |       |   ent: timestamp  |       | +created_at:      |
| +updated_at:      |       | +etat_validation: |       |   timestamp       |
|   timestamp       |       |   String          |       | +updated_at:      |
+-------------------+       | +created_at:      |       |   timestamp       |
                            |   timestamp       |       +-------------------+
                            | +updated_at:      |
                            |   timestamp       |
                            +-------------------+
```
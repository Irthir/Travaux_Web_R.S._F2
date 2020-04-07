USE dbcommerce;

-- Calculer la répartition du chiffre d'affaire par localité et par produit ; On affichera donc la localité, le produit et le CA.
SELECT ville as LOCALITE, designation as PRODUIT, produit.numproduit as NUMERO_PRODUIT, CONCAT(prixHT*qtecommande,"€") as CA
FROM client, commande, detail, produit
WHERE client.numclient = commande.numclient AND commande.numcommande = detail.numcommande AND detail.numproduit = produit.numproduit
GROUP BY LOCALITE, PRODUIT
ORDER BY LOCALITE ASC;

-- Liste des produits en rupture de stock
SELECT numproduit, designation, prixHT
FROM Produit
WHERE stock<=0;


-- Mettre à jour la quantité de Stock des produits
-- UPDATE Produit SET stock = $stockproduit WHERE numproduit = $NumProduit;
UPDATE Produit
SET stock = 45
WHERE numproduit = 'CS262';

-- Augmenter le stock de 1 d'un produit.
-- UPDATE Produit SET stock = (SELECT stock WHERE numproduit = $NumProduit)+1 WHERE numproduit = $NumProduit;
UPDATE Produit
SET stock = (SELECT stock WHERE numproduit= 'CS262')+1
WHERE numproduit = 'CS262';

-- Diminuer le stock de 1 d'un produit.
-- UPDATE Produit SET stock = (SELECT stock WHERE numproduit = $NumProduit)-1 WHERE numproduit = $NumProduit;
UPDATE Produit
SET stock = (SELECT stock WHERE numproduit= 'CS262')-1
WHERE numproduit = 'CS262';
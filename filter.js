
function mapNumeriqueCroissant(tab) {
    tab.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));

    return tab;

}
function mapNumeriqueDeCroissant(tab) {
    tab.sort((a, b) => parseFloat(b.price) - parseFloat(a.price));

    return tab;

}

public class balok {
    private double panjang;
    private double lebar;
    private double tinggi;
    
    // Setter methods
    public void setPanjang(double panjang) {
        this.panjang = panjang;
    }
    
    public void setLebar(double lebar) {
        this.lebar = lebar;
    }
    
    public void setTinggi(double tinggi) {
        this.tinggi = tinggi;
    }
    
    // Getter methods
    public double getPanjang() {
        return panjang;
    }
    
    public double getLebar() {
        return lebar;
    }
    
    public double getTinggi() {
        return tinggi;
    }
    
    // Calculate surface area (Luas Permukaan)
    public double getLuasPermukaan() {
        return 2 * ((panjang * lebar) + (panjang * tinggi) + (lebar * tinggi));
    }
    
    // Calculate volume
    public double getVolume() {
        return panjang * lebar * tinggi;
    }
}
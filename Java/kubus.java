public class kubus {
    private double sisi;
    
    public void setSisi(double sisi) {
        this.sisi = sisi;
    }
    
    public double getSisi() {
        return sisi;
    }
    
    public double getLuasPermukaan() {
        return 6 * sisi * sisi;
    }
    
    public double getVolume() {
        return sisi * sisi * sisi;
    }
}
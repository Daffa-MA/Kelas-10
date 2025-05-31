import java.util.Scanner;

class Persegi {
    private double sisi;
    
    public void setSisi(double sisi) {
        this.sisi = sisi;
    }
    
    public double getSisi() {
        return this.sisi;
    }
    
    public double hitungKeliling() {
        return 4 * this.sisi;
    }
}

public class shoot {
    public static void main(String[] args) {
        Persegi persegi = new Persegi();
        Scanner input = new Scanner(System.in);
        
        System.out.print("Masukkan panjang sisi persegi: ");
        double sisi = input.nextDouble();
        
        persegi.setSisi(sisi);
        
        System.out.println("\nHasil Perhitungan Keliling Persegi:");
        System.out.println("Panjang Sisi: " + persegi.getSisi());
        System.out.println("Keliling: " + persegi.hitungKeliling());
        
        input.close();
    }
}
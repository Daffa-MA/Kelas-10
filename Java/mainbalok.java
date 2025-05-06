import java.util.Scanner;
import java.util.InputMismatchException;

public class mainbalok {
    public static void main(String[] args) {
        balok blk = new balok();
        Scanner in = new Scanner(System.in);
        
        try {
            System.out.println("=== Program Perhitungan Balok ===");
            System.out.print("Masukkan panjang balok : ");
            double panjang = in.nextDouble();
            if (panjang <= 0) throw new IllegalArgumentException("Panjang harus lebih dari 0");
            
            System.out.print("Masukkan lebar balok : ");
            double lebar = in.nextDouble();
            if (lebar <= 0) throw new IllegalArgumentException("Lebar harus lebih dari 0");
            
            System.out.print("Masukkan tinggi balok : ");
            double tinggi = in.nextDouble();
            if (tinggi <= 0) throw new IllegalArgumentException("Tinggi harus lebih dari 0");
            
            blk.setPanjang(panjang);
            blk.setLebar(lebar);
            blk.setTinggi(tinggi);
            
            System.out.println("\n=== Hasil Perhitungan Balok ===");
            System.out.printf("Panjang Balok: %.2f%n", blk.getPanjang());
            System.out.printf("Lebar Balok: %.2f%n", blk.getLebar());
            System.out.printf("Tinggi Balok: %.2f%n", blk.getTinggi());
            System.out.printf("Luas Permukaan: %.2f%n", blk.getLuasPermukaan());
            System.out.printf("Volume: %.2f%n", blk.getVolume());
            
        } catch (InputMismatchException e) {
            System.out.println("Error: Masukan harus berupa angka!");
        } catch (IllegalArgumentException e) {
            System.out.println("Error: " + e.getMessage());
        } finally {
            in.close();
        }
    }
}
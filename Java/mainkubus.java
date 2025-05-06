import java.util.Scanner;

public class mainkubus {
    public static void main(String[] args) {
        kubus kbs = new kubus();  // Create instance of kubus class
        Scanner in = new Scanner(System.in);
        
        System.out.print("Masukkan sisi kubus : ");
        double sisi = in.nextDouble();
        
        kbs.setSisi(sisi);
        
        System.out.println("\nHasil Perhitungan Kubus:");
        System.out.println("Sisi Kubus: " + kbs.getSisi());
        System.out.println("Luas Permukaan: " + kbs.getLuasPermukaan());
        System.out.println("Volume: " + kbs.getVolume());
        
        in.close();
    }
}
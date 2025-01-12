import javax.swing.JOptionPane;

public class InputDataJOptionPane {
    public static void main(String[] args) {
        // Mengambil input nama (String)
        String nama = JOptionPane.showInputDialog("Masukkan nama Anda:");

        // Mengambil input usia (String) dan mengonversinya menjadi int
        String usiaString = JOptionPane.showInputDialog("Masukkan usia Anda:");
        int usia = Integer.parseInt(usiaString);

        // Mengambil input tinggi badan (String) dan mengonversinya menjadi double
        String tinggiBadanString = JOptionPane.showInputDialog("Masukkan tinggi badan Anda (dalam cm):");
        double tinggiBadan = Double.parseDouble(tinggiBadanString);

        // Menampilkan hasil input menggunakan JOptionPane
        String message = "Informasi yang Anda masukkan:\n" +
                         "Nama: " + nama + "\n" +
                         "Usia: " + usia + " tahun\n" +
                         "Tinggi badan: " + tinggiBadan + " cm";
        JOptionPane.showMessageDialog(null, message);
    }
}

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Nov 2017 pada 15.27
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro_ryan`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `bd_id` () RETURNS INT(11) BEGIN
	DECLARE x INT;
	SELECT COUNT(id_pasien) INTO x 
	FROM pasien WHERE DATE_FORMAT(tgl_lahir,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d');
RETURN x;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getPoli` (`id` VARCHAR(5)) RETURNS INT(11) BEGIN
							DECLARE x INT;
							SELECT COUNT(no_queue) + 1 INTO x
							FROM queue 
							WHERE LEFT(no_queue,1) = id 
							AND DATE(waktu) = DATE(NOW());
						RETURN x;
						END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `barang`
--
-- --------------------------------------------------------

--
-- Struktur dari tabel `barcode`
--

CREATE TABLE `barcode` (
  `nilai` varchar(45) NOT NULL,
  `nama_barang` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barcode`
--

INSERT INTO `barcode` (`nilai`, `nama_barang`) VALUES
('77889a66512', 'Produk X'),
('78966687575766', 'Produk Z'),
('8809976152', 'Produk P'),
('9988776554443', 'Produk Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coupon`
--

CREATE TABLE `coupon` (
  `id_coupon` varchar(45) NOT NULL,
  `id_customer` varchar(45) NOT NULL,
  `coupon` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `coupon`
--

INSERT INTO `coupon` (`id_coupon`, `id_customer`, `coupon`) VALUES
('TR-2017-06-16-0001', 'PS20170001', 'bd-06-16-26f10-001'),
('TR-2017-06-20-0002', 'CS-002', 'bd-06-20-5fb5c-000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(45) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `asal_daerah` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `tgl_lhr`, `alamat`, `asal_daerah`, `status`) VALUES
('CS-00001', 'Dina Haryanti', '1992-11-04', 'Jalan Kedawung Hijau No 43', 'CIREBON', 'Aktif'),
('CS-00002', 'Ali Al Azhar', '1976-02-03', 'Jalan Lemahwungkuk 03', 'NAGAN RAYA', 'Aktif'),
('CS-00003', 'Intan Permata Putri', '1997-11-03', 'Jalan Palang Merah No 14', 'TANAH DATAR', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon_barang`
--

CREATE TABLE `diskon_barang` (
  `id_diskon` int(11) NOT NULL,
  `id_barang` varchar(45) NOT NULL,
  `jumlah_diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diskon_barang`
--

INSERT INTO `diskon_barang` (`id_diskon`, `id_barang`, `jumlah_diskon`) VALUES
(1, 'GH0921', 10),
(2, 'KD0808121', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon_coupon`
--

CREATE TABLE `diskon_coupon` (
  `id_diskon` int(11) NOT NULL,
  `jumlah_diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diskon_coupon`
--

INSERT INTO `diskon_coupon` (`id_diskon`, `jumlah_diskon`) VALUES
(1, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon_p`
--

CREATE TABLE `diskon_p` (
  `id_penjualan` varchar(100) NOT NULL,
  `id_customer` varchar(45) NOT NULL,
  `jumlah_diskon` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon_pembelian`
--

CREATE TABLE `diskon_pembelian` (
  `id_diskon` int(11) NOT NULL,
  `minimal_pembelian` int(11) DEFAULT NULL,
  `jumlah_diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diskon_pembelian`
--

INSERT INTO `diskon_pembelian` (`id_diskon`, `minimal_pembelian`, `jumlah_diskon`) VALUES
(1, 50000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pembelian`
--

CREATE TABLE `dt_pembelian` (
  `id_pembelian` varchar(45) NOT NULL,
  `id_barang` varchar(45) NOT NULL,
  `kategori` varchar(45) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `ppn` int(11) NOT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `jumlah_beli` int(11) DEFAULT NULL,
  `satuan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_penjualan`
--

CREATE TABLE `dt_penjualan` (
  `id_penjualan` varchar(45) NOT NULL,
  `id_barang` varchar(45) NOT NULL,
  `jumlah_jual` int(11) DEFAULT NULL,
  `diskon_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `kode_gudang` varchar(45) NOT NULL,
  `nama_gudang` varchar(45) NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `kontak` varchar(45) NOT NULL,
  `cabang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id`, `kode_gudang`, `nama_gudang`, `alamat`, `kontak`, `cabang_id`) VALUES
(1, 'GD01', 'Gudang 1', 'Jalan X', '134122', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id_barang` varchar(45) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_retail` int(11) NOT NULL,
  `sn` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`id_barang`, `harga_beli`, `harga_retail`, `sn`) VALUES
('AFK001', 2000000, 2000, NULL),
('AFK002', 3000000, 5000, '@AFK002100'),
('LK012', 1000000, 1000, '@LK01210'),
('LK012', 1000000, 1000, '@LK01230');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `Nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`Nama`) VALUES
('ACEH SELATAN'),
('ACEH TENGGARA'),
('ACEH TIMUR'),
('ACEH TENGAH'),
('ACEH BARAT'),
('ACEH BESAR'),
('PIDIE'),
('ACEH UTARA'),
('SIMEULUE'),
('ACEH SINGKIL'),
('BIREUEN'),
('ACEH BARAT DAYA'),
('GAYO LUES'),
('ACEH JAYA'),
('NAGAN RAYA'),
('ACEH TAMIANG'),
('BENER MERIAH'),
('PIDIE JAYA'),
('KOTA BANDA ACEH'),
('KOTA SABANG'),
('KOTA LHOKSEUMAWE'),
('KOTA LANGSA'),
('KOTA SUBULUSSALAM'),
('LABUHANBATU SELATAN'),
('LABUHANBATU UTARA'),
('NIAS UTARA'),
('NIAS BARAT'),
('KOTA GUNUNGSITOLI'),
('TAPANULI TENGAH'),
('TAPANULI UTARA'),
('TAPANULI SELATAN'),
('NIAS'),
('LANGKAT'),
('KARO'),
('DELI SERDANG'),
('SIMALUNGUN'),
('ASAHAN'),
('LABUHANBATU'),
('DAIRI'),
('TOBA SAMOSIR'),
('MANDAILING NATAL'),
('NIAS SELATAN'),
('PAKPAK BHARAT'),
('HUMBANG HASUNDUTAN'),
('SAMOSIR'),
('SERDANG BEDAGAI'),
('BATU BARA'),
('KOTA MEDAN'),
('KOTA PEMATANGSIANTAR'),
('KOTA SIBOLGA'),
('KOTA TANJUNG BALAI'),
('KOTA BINJAI'),
('KOTA TEBING TINGGI'),
('KOTA PADANG SIDIMPUAN'),
('PADANG LAWAS UTARA'),
('PADANG LAWAS'),
('PESISIR SELATAN'),
('SOLOK'),
('SIJUNJUNG'),
('TANAH DATAR'),
('PADANG PARIAMAN'),
('AGAM'),
('LIMA PULUH KOTA'),
('PASAMAN'),
('KEPULAUAN MENTAWAI'),
('DHARMASRAYA'),
('SOLOK SELATAN'),
('PASAMAN BARAT'),
('KOTA PADANG'),
('KOTA SOLOK'),
('KOTA SAWAHLUNTO'),
('KOTA PADANG PANJANG'),
('KOTA BUKITTINGGI'),
('KOTA PAYAKUMBUH'),
('KOTA PARIAMAN'),
('KEPULAUAN MERANTI'),
('KAMPAR'),
('INDRAGIRI HULU'),
('BENGKALIS'),
('INDRAGIRI HILIR'),
('PELALAWAN'),
('ROKAN HULU'),
('ROKAN HILIR'),
('SIAK'),
('KUANTAN SINGINGI'),
('KOTA PEKANBARU'),
('KOTA DUMAI'),
('KOTA SUNGAI PENUH'),
('KERINCI'),
('MERANGIN'),
('SAROLANGUN'),
('BATANGHARI'),
('MUARO JAMBI'),
('TANJUNG JABUNG BARAT'),
('TANJUNG JABUNG TIMUR'),
('BUNGO'),
('TEBO'),
('KOTA JAMBI'),
('OGAN KOMERING ULU'),
('OGAN KOMERING ILIR'),
('MUARA ENIM'),
('LAHAT'),
('MUSI RAWAS'),
('MUSI BANYUASIN'),
('BANYUASIN'),
('OGAN KOMERING ULU TIMUR'),
('OGAN KOMERING ULU SELATAN'),
('OGAN ILIR'),
('EMPAT LAWANG'),
('KOTA PALEMBANG'),
('KOTA PAGAR ALAM'),
('KOTA LUBUKLINGGAU'),
('KOTA PRABUMULIH'),
('BENGKULU TENGAH'),
('BENGKULU SELATAN'),
('REJANG LEBONG'),
('BENGKULU UTARA'),
('KAUR'),
('SELUMA'),
('MUKOMUKO'),
('LEBONG'),
('KEPAHIANG'),
('KOTA BENGKULU'),
('PRINGSEWU'),
('MESUJI'),
('TULANG BAWANG BARAT'),
('LAMPUNG SELATAN'),
('LAMPUNG TENGAH'),
('LAMPUNG UTARA'),
('LAMPUNG BARAT'),
('TULANG BAWANG'),
('TANGGAMUS'),
('LAMPUNG TIMUR'),
('WAY KANAN'),
('KOTA BANDAR LAMPUNG'),
('KOTA METRO'),
('PESAWARAN'),
('BANGKA'),
('BELITUNG'),
('BANGKA SELATAN'),
('BANGKA TENGAH'),
('BANGKA BARAT'),
('BELITUNG TIMUR'),
('KOTA PANGKALPINANG'),
('KOTA TANJUNGPINANG'),
('KEPULAUAN ANAMBAS'),
('BINTAN'),
('KARIMUN'),
('NATUNA'),
('LINGGA'),
('KOTA BATAM'),
('KEPULAUAN SERIBU'),
('JAKARTA PUSAT'),
('JAKARTA UTARA'),
('JAKARTA BARAT'),
('JAKARTA SELATAN'),
('JAKARTA TIMUR'),
('BOGOR'),
('SUKABUMI'),
('CIANJUR'),
('BANDUNG'),
('GARUT'),
('TASIKMALAYA'),
('CIAMIS'),
('KUNINGAN'),
('CIREBON'),
('MAJALENGKA'),
('SUMEDANG'),
('INDRAMAYU'),
('SUBANG'),
('PURWAKARTA'),
('KARAWANG'),
('BEKASI'),
('BANDUNG BARAT'),
('KOTA BOGOR'),
('KOTA SUKABUMI'),
('KOTA BANDUNG'),
('KOTA CIREBON'),
('KOTA BEKASI'),
('KOTA DEPOK'),
('KOTA CIMAHI'),
('KOTA TASIKMALAYA'),
('KOTA BANJAR'),
('CILACAP'),
('BANYUMAS'),
('PURBALINGGA'),
('BANJARNEGARA'),
('KEBUMEN'),
('PURWOREJO'),
('WONOSOBO'),
('MAGELANG'),
('BOYOLALI'),
('KLATEN'),
('SUKOHARJO'),
('WONOGIRI'),
('KARANGANYAR'),
('SRAGEN'),
('GROBOGAN'),
('BLORA'),
('REMBANG'),
('PATI'),
('KUDUS'),
('JEPARA'),
('DEMAK'),
('SEMARANG'),
('TEMANGGUNG'),
('KENDAL'),
('BATANG'),
('PEKALONGAN'),
('PEMALANG'),
('TEGAL'),
('BREBES'),
('KOTA MAGELANG'),
('KOTA SURAKARTA'),
('KOTA SALATIGA'),
('KOTA SEMARANG'),
('KOTA PEKALONGAN'),
('KOTA TEGAL'),
('KULON PROGO'),
('BANTUL'),
('GUNUNGKIDUL'),
('SLEMAN'),
('KOTA YOGYAKARTA'),
('PACITAN'),
('PONOROGO'),
('TRENGGALEK'),
('TULUNGAGUNG'),
('BLITAR'),
('KEDIRI'),
('MALANG'),
('LUMAJANG'),
('JEMBER'),
('BANYUWANGI'),
('BONDOWOSO'),
('SITUBONDO'),
('PROBOLINGGO'),
('PASURUAN'),
('SIDOARJO'),
('MOJOKERTO'),
('JOMBANG'),
('NGANJUK'),
('MADIUN'),
('MAGETAN'),
('NGAWI'),
('BOJONEGORO'),
('TUBAN'),
('LAMONGAN'),
('GRESIK'),
('BANGKALAN'),
('SAMPANG'),
('PAMEKASAN'),
('SUMENEP'),
('KOTA KEDIRI'),
('KOTA BLITAR'),
('KOTA MALANG'),
('KOTA PROBOLINGGO'),
('KOTA PASURUAN'),
('KOTA MOJOKERTO'),
('KOTA MADIUN'),
('KOTA SURABAYA'),
('KOTA BATU'),
('PANDEGLANG'),
('LEBAK'),
('TANGERANG'),
('SERANG'),
('KOTA TANGERANG'),
('KOTA CILEGON'),
('KOTA SERANG'),
('KOTA TANGERANG SELATAN'),
('JEMBRANA'),
('TABANAN'),
('BADUNG'),
('GIANYAR'),
('KLUNGKUNG'),
('BANGLI'),
('KARANGASEM'),
('BULELENG'),
('KOTA DENPASAR'),
('LOMBOK BARAT'),
('LOMBOK TENGAH'),
('LOMBOK TIMUR'),
('SUMBAWA'),
('DOMPU'),
('BIMA'),
('SUMBAWA BARAT'),
('KOTA MATARAM'),
('KOTA BIMA'),
('LOMBOK UTARA'),
('KUPANG'),
('TIMOR TENGAH SELATAN'),
('TIMOR TENGAH UTARA'),
('BELU'),
('ALOR'),
('FLORES TIMUR'),
('SIKKA'),
('ENDE'),
('NGADA'),
('MANGGARAI'),
('SUMBA TIMUR'),
('SUMBA BARAT'),
('LEMBATA'),
('ROTE NDAO'),
('MANGGARAI BARAT'),
('NAGEKEO'),
('SUMBA TENGAH'),
('SUMBA BARAT DAYA'),
('KOTA KUPANG'),
('MANGGARAI TIMUR'),
('SABU RAIJUA'),
('SAMBAS'),
('PONTIANAK'),
('SANGGAU'),
('KETAPANG'),
('SINTANG'),
('KAPUAS HULU'),
('BENGKAYANG'),
('LANDAK'),
('SEKADAU'),
('MELAWI'),
('KAYONG UTARA'),
('KOTA PONTIANAK'),
('KOTA SINGKAWANG'),
('KUBU RAYA'),
('KOTAWARINGIN BARAT'),
('KOTAWARINGIN TIMUR'),
('KAPUAS'),
('BARITO SELATAN'),
('BARITO UTARA'),
('KATINGAN'),
('SERUYAN'),
('SUKAMARA'),
('LAMANDAU'),
('GUNUNG MAS'),
('PULANG PISAU'),
('MURUNG RAYA'),
('BARITO TIMUR'),
('KOTA PALANGKARAYA'),
('TANAH LAUT'),
('KOTABARU'),
('BANJAR'),
('BARITO KUALA'),
('TAPIN'),
('HULU SUNGAI SELATAN'),
('HULU SUNGAI TENGAH'),
('HULU SUNGAI UTARA'),
('TABALONG'),
('TANAH BUMBU'),
('BALANGAN'),
('KOTA BANJARMASIN'),
('KOTA BANJARBARU'),
('PASER'),
('KUTAI KARTANEGARA'),
('BERAU'),
('BULUNGAN'),
('NUNUKAN'),
('MALINAU'),
('KUTAI BARAT'),
('KUTAI TIMUR'),
('PENAJAM PASER UTARA'),
('KOTA BALIKPAPAN'),
('KOTA SAMARINDA'),
('KOTA TARAKAN'),
('KOTA BONTANG'),
('TANA TIDUNG'),
('BOLAANG MONGONDOW TIMUR'),
('BOLAANG MONGONDOW SELATAN'),
('BOLAANG MONGONDOW'),
('MINAHASA'),
('KEPULAUAN SANGIHE'),
('KEPULAUAN TALAUD'),
('MINAHASA SELATAN'),
('MINAHASA UTARA'),
('MINAHASA TENGGARA'),
('BOLAANG MONGONDOW UTARA'),
('KEP. SIAU TAGULANDANG BIARO'),
('KOTA MANADO'),
('KOTA BITUNG'),
('KOTA TOMOHON'),
('KOTA KOTAMOBAGU'),
('SIGI'),
('BANGGAI'),
('POSO'),
('DONGGALA'),
('TOLITOLI'),
('BUOL'),
('MOROWALI'),
('BANGGAI KEPULAUAN'),
('PARIGI MOUTONG'),
('TOJO UNA-UNA'),
('KOTA PALU'),
('TORAJA UTARA'),
('KEPULAUAN SELAYAR'),
('BULUKUMBA'),
('BANTAENG'),
('JENEPONTO'),
('TAKALAR'),
('GOWA'),
('SINJAI'),
('BONE'),
('MAROS'),
('PANGKAJENE DAN KEPULAUAN'),
('BARRU'),
('SOPPENG'),
('WAJO'),
('SIDENRENG RAPPANG'),
('PINRANG'),
('ENREKANG'),
('LUWU'),
('TANA TORAJA'),
('LUWU UTARA'),
('LUWU TIMUR'),
('KOTA MAKASSAR'),
('KOTA PARE PARE'),
('KOTA PALOPO'),
('KOLAKA'),
('KONAWE'),
('MUNA'),
('BUTON'),
('KONAWE SELATAN'),
('BOMBANA'),
('WAKATOBI'),
('KOLAKA UTARA'),
('KONAWE UTARA'),
('BUTON UTARA'),
('KOTA KENDARI'),
('KOTA BAU BAU'),
('GORONTALO'),
('BOALEMO'),
('BONE BOLANGO'),
('PAHUWATO'),
('GORONTALO UTARA'),
('KOTA GORONTALO'),
('MAMUJU UTARA'),
('MAMUJU'),
('MAMASA'),
('POLEWALI MANDAR'),
('MAJENE'),
('MALUKU BARAT DAYA'),
('BURU SELATAN'),
('MALUKU TENGAH'),
('MALUKU TENGGARA'),
('MALUKU TENGGARA BARAT'),
('BURU'),
('SERAM BAGIAN TIMUR'),
('SERAM BAGIAN BARAT'),
('KEPULAUAN ARU'),
('KOTA AMBON'),
('KOTA TUAL'),
('PULAU MOROTAI'),
('HALMAHERA BARAT'),
('HALMAHERA TENGAH'),
('HALMAHERA UTARA'),
('HALMAHERA SELATAN'),
('KEPULAUAN SULA'),
('HALMAHERA TIMUR'),
('KOTA TERNATE'),
('KOTA TIDORE KEPULAUAN'),
('INTAN JAYA'),
('DEIYAI'),
('TOLIKARA'),
('WAROPEN'),
('BOVEN DIGOEL'),
('MAPPI'),
('ASMAT'),
('SUPIORI'),
('MAMBERAMO RAYA'),
('KOTA JAYAPURA'),
('MAMBERAMO TENGAH'),
('YALIMO'),
('LANNY JAYA'),
('NDUGA'),
('PUNCAK'),
('DOGIYAI'),
('MERAUKE'),
('JAYAWIJAYA'),
('JAYAPURA'),
('NABIRE'),
('KEPULAUAN YAPEN'),
('BIAK NUMFOR'),
('PUNCAK JAYA'),
('PANIAI'),
('MIMIKA'),
('SARMI'),
('KEEROM'),
('PEGUNUNGAN BINTANG'),
('YAHUKIMO'),
('MAYBRAT'),
('TAMBRAUW'),
('SORONG'),
('MANOKWARI'),
('FAKFAK'),
('SORONG SELATAN'),
('RAJA AMPAT'),
('TELUK BINTUNI'),
('TELUK WONDAMA'),
('KAIMANA'),
('KOTA SORONG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nip` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` text NOT NULL,
  `cabang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nip`, `type`, `nama`, `alamat`, `kontak`, `cabang`) VALUES
(12334, 2, 'Dimas Andi', 'Cirebon', '123412', 1),
(123411, 2, 'Angga Ardiyansyah', 'Jakarta', '1414524', 1),
(441112, 3, 'Lolita', 'Cirebon', '08122131', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_type`
--

CREATE TABLE `karyawan_type` (
  `id_type` int(11) NOT NULL,
  `nama_type` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `karyawan_type`
--

INSERT INTO `karyawan_type` (`id_type`, `nama_type`, `status`) VALUES
(1, 'Developer', 'Aktif'),
(2, 'Tester', 'Aktif'),
(3, 'Manager', 'Aktif'),
(4, 'Staff', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_cabang`
--

CREATE TABLE `m_cabang` (
  `cabang_kode` varchar(200) NOT NULL,
  `cabang_nama` varchar(255) NOT NULL,
  `cabang_alamat` varchar(255) NOT NULL,
  `cabang_kota` varchar(255) NOT NULL,
  `cabang_telepon` varchar(255) NOT NULL,
  `cabang_fax` varchar(255) DEFAULT NULL,
  `cabang_email` varchar(255) DEFAULT NULL,
  `cabang_status_aktif` char(1) NOT NULL,
  `cabang_gudangdisplay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_cabang`
--

INSERT INTO `m_cabang` (`cabang_kode`, `cabang_nama`, `cabang_alamat`, `cabang_kota`, `cabang_telepon`, `cabang_fax`, `cabang_email`, `cabang_status_aktif`, `cabang_gudangdisplay`) VALUES
('T001', 'PT. TEKNIK ANDHALAN NUSANTARA GLOBAL', 'JL. KARTINI NO 41 - 45', '3525', '["031. 3974785 \\/ 3972222 (fax)"]', '["031"]', '["cabang1@gmail.com"]', 'y', 2),
('T002', 'CABANG1TEST', 'CABANG1ALAMAT', '3578', '["11111"]', '["1111"]', '["email@email.com"]', 'y', 0),
('T003', 'Cabang 3', 'Alamat Cabangvv', '1107', '["0218412487142","08364238733","0384834934342"]', '["04783246932","08324234234"]', '["cabang3@gmail.com","cabang_3@cabang.com"]', 'y', 0),
('T004', 'cabang coba', 'qqq', '1107', '["123"]', '["123"]', '["qw@qw"]', 'n', 0),
('T005', 'Cabang Testing 1', 'Alamat cabang testing 1', '1107', '["123456789"]', '["123"]', '["cabangtesting1@gmail.com"]', 'y', 3),
('T006', 'Test Cabang', 'Alamat Cabang', '3172', '["099999"]', '["099999999999"]', '["google@google.com"]', 'y', 0),
('T007', 'Cabang Testing 2', 'cabangtesting2', '3578', '["777"]', '["5655"]', '["cabangtesting2@gmail.com"]', 'y', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_category_2`
--

CREATE TABLE `m_category_2` (
  `category_2_id` int(11) NOT NULL,
  `m_jenis_barang_id` int(11) DEFAULT NULL,
  `category_2_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_category_2`
--

INSERT INTO `m_category_2` (`category_2_id`, `m_jenis_barang_id`, `category_2_nama`) VALUES
(1, 1, 'Mesin Bor'),
(2, 1, 'Mesin Potong'),
(3, 1, 'Mesin Finishing'),
(4, 2, 'Catok & Klem'),
(5, 2, 'Palu'),
(6, 2, 'Tang'),
(7, 2, 'Obeng'),
(8, 2, 'Kunci Sock'),
(9, 2, 'Kunci'),
(10, 2, 'Kunci L'),
(11, 2, 'Alat Potong'),
(12, 2, 'Alat Finishing'),
(13, 2, 'Tool Box '),
(14, 2, 'Alat Ukur'),
(15, 3, 'Mata Bor'),
(16, 3, 'Mata Potong'),
(17, 3, 'Mata Ketok'),
(18, 3, 'Handtaps & Snei'),
(19, 3, 'Finishing'),
(20, 4, 'Generator'),
(21, 4, 'Engine '),
(22, 4, 'Mesin Pompa'),
(23, 4, 'Mesin Segel'),
(24, 4, 'Blower'),
(25, 4, 'Mesin Pembersih'),
(26, 4, 'Pelumas '),
(27, 5, 'Mesin Kompresor'),
(28, 5, 'Aksesoris Kompresor'),
(29, 6, 'Mesin Las'),
(30, 6, 'Aksesoris Mesin Las'),
(31, 6, 'Kawat Las'),
(32, 7, 'Alat Pelindung Diri'),
(33, 7, 'Alat Pemadam'),
(34, 8, 'Roda'),
(35, 8, 'Dongkrak & Aksesoris'),
(36, 8, 'Chainblock'),
(37, 8, 'Aksesoris'),
(38, 9, 'Lampu '),
(39, 9, 'Fitting Lampu'),
(40, 9, 'Baterai'),
(41, 9, 'Kabel'),
(42, 9, 'Saklar'),
(43, 10, 'Tile'),
(44, 10, 'Granite Tile'),
(45, 11, 'Paint'),
(46, 11, 'Waterproof'),
(47, 12, 'Semen '),
(48, 12, 'Bata Ringan'),
(49, 12, 'Glassblock'),
(50, 12, 'Tangga'),
(51, 12, 'Tandon Air'),
(52, 12, 'Kipas Angin'),
(53, 13, 'Kran'),
(54, 13, 'Wastafel'),
(55, 13, 'Closet'),
(56, 13, 'Perlengkapan'),
(57, 14, 'Water Heater'),
(58, 14, 'Pompa Air'),
(59, 15, 'Pintu'),
(60, 15, 'Handle & Engsel'),
(61, 15, 'Gembok'),
(62, 1, 'aksesoris power tools'),
(63, 13, 'BAK AIR'),
(64, 12, 'KACA FILM'),
(65, 16, 'perlengkapan kantor'),
(66, 12, 'besi'),
(67, 17, 'PARFUM'),
(68, 17, 'otomotif'),
(69, 12, 'LEM'),
(70, 9, 'alat penerangan'),
(71, 13, 'PIPA'),
(72, 13, 'WATER HEATER'),
(73, 13, 'KOMPOR'),
(74, 18, 'ASESORIS'),
(75, 9, 'aksesoris'),
(76, 11, 'CAT'),
(77, 16, 'KARPET'),
(78, 19, 'Category 2Testing 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_jenis_barang`
--

CREATE TABLE `m_jenis_barang` (
  `jenis_barang_id` int(11) NOT NULL,
  `jenis_barang_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_jenis_barang`
--

INSERT INTO `m_jenis_barang` (`jenis_barang_id`, `jenis_barang_nama`) VALUES
(1, 'Power Tools'),
(2, 'Tools'),
(3, 'Cutting & Finishing'),
(4, 'Machinery'),
(5, 'Air Compressor'),
(6, 'Welding'),
(7, 'Safety & Protection'),
(8, 'Material Handling'),
(9, 'Electrical & Lighting'),
(10, 'Flooring'),
(11, 'Painting'),
(12, 'Building Supplies'),
(13, 'Sanitary'),
(14, 'Pumps'),
(15, 'Door & Windows'),
(16, 'FURNITURE'),
(17, 'OTOMOTIF'),
(18, 'HADWARE'),
(19, 'Category 1Testing 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(45) NOT NULL,
  `invoice` text NOT NULL,
  `id_supplier` varchar(45) NOT NULL,
  `tgl_pembelian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `pembelian`
--
DELIMITER $$
CREATE TRIGGER `pembelian_ADEL` AFTER DELETE ON `pembelian` FOR EACH ROW BEGIN
	DELETE FROM dt_pembelian WHERE id_pembelian = Old.id_pembelian;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan_barang`
--

CREATE TABLE `penerimaan_barang` (
  `kode_bpb` varchar(45) NOT NULL,
  `tgl_bpb` date DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `kode_supplier` varchar(45) DEFAULT NULL,
  `pemeriksa` varchar(45) DEFAULT NULL,
  `penyetuju` varchar(45) DEFAULT NULL,
  `kode_gudang` varchar(45) NOT NULL,
  `no_sj` varchar(45) DEFAULT NULL,
  `no_po` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `penerimaan_barang`
--

INSERT INTO `penerimaan_barang` (`kode_bpb`, `tgl_bpb`, `tgl_terima`, `kode_supplier`, `pemeriksa`, `penyetuju`, `kode_gudang`, `no_sj`, `no_po`) VALUES
('BPB-2017-11-16-00002', NULL, NULL, NULL, NULL, NULL, 'GD01', NULL, NULL),
('BPB11201700001', '2017-11-16', '2017-11-30', 'RX-001', '123411', '441112', 'GD01', '0077712', 'PO20171116001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan_barang_dt`
--

CREATE TABLE `penerimaan_barang_dt` (
  `kode_bpb` varchar(45) NOT NULL,
  `kode_barang` varchar(45) NOT NULL,
  `nama_barang` varchar(45) NOT NULL,
  `uraian` text NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(45) NOT NULL,
  `qty_ctrl` int(11) NOT NULL DEFAULT '0',
  `unit_ctrl` varchar(45) DEFAULT NULL,
  `sn` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `penerimaan_barang_dt`
--

INSERT INTO `penerimaan_barang_dt` (`kode_bpb`, `kode_barang`, `nama_barang`, `uraian`, `qty`, `satuan`, `qty_ctrl`, `unit_ctrl`, `sn`) VALUES
('BPB11201700001', 'AFK001', 'Barang 1', 'Barang Bagus, Baru', 100, 'Box', 0, 'Null', 'Null'),
('BPB11201700001', 'AFK002', 'Barang 2 Qty Ctrl', 'Barang Qty Control', 20, 'Box', 100, 'Big Box', '@AFK002100'),
('BPB-2017-11-16-00002', 'LK012', 'Karang', 'Test', 12, 'Box', 10, 'Cartoon', '@LK01210'),
('BPB-2017-11-16-00002', 'LK012', 'Karang', 'Haha', 10, 'Box', 30, 'Mini Box', '@LK01230');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(45) NOT NULL,
  `id_customer` varchar(45) NOT NULL,
  `tgl_penjualan` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `penjualan`
--
DELIMITER $$
CREATE TRIGGER `penjualan_ADEL` AFTER DELETE ON `penjualan` FOR EACH ROW BEGIN 
	DELETE FROM dt_penjualan WHERE id_penjualan = Old.id_penjualan;
	DELETE FROM diskon_p WHERE id_penjualan = Old.id_penjualan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `salesman`
--

CREATE TABLE `salesman` (
  `kode_sales` varchar(45) NOT NULL,
  `nama_sales` varchar(45) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `salesman`
--

INSERT INTO `salesman` (`kode_sales`, `nama_sales`, `alamat`, `kontak`, `status`) VALUES
('SLS-00001', 'Andi Amiruddin', 'Jalan Sate Kambing No 13', '0881312', 'Aktif'),
('SLS-00002', 'Dimas Adi Putra', 'Jalan Sate Mawar No 13', '0881312', 'Aktif'),
('SLS-00003', 'Dwi Putra Laksana', 'Jalan Kemenyan No 89', '89767852', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `nama_satuan` varchar(45) NOT NULL,
  `level_satuan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`nama_satuan`, `level_satuan`) VALUES
('Botol', 'Level 3'),
('Box', 'Level 1'),
('NULL', 'Level 0'),
('Pack', 'Level 2'),
('Strip', 'Level 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_barang_low`
--

CREATE TABLE `satuan_barang_low` (
  `id_barang` varchar(45) NOT NULL,
  `nama_satuan` varchar(45) DEFAULT NULL,
  `dt_qty` int(11) NOT NULL DEFAULT '1',
  `sn` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan_barang_low`
--

INSERT INTO `satuan_barang_low` (`id_barang`, `nama_satuan`, `dt_qty`, `sn`) VALUES
('AFK001', 'Botol', 50, NULL),
('AFK002', 'Botol', 30, '@AFK002100'),
('LK012', 'Botol', 10, '@LK01210'),
('LK012', 'Botol', 10, '@LK01230');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_barang_mid`
--

CREATE TABLE `satuan_barang_mid` (
  `id_barang` varchar(45) NOT NULL,
  `nama_satuan` varchar(45) DEFAULT NULL,
  `dt_qty` int(11) NOT NULL DEFAULT '1',
  `sn` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan_barang_mid`
--

INSERT INTO `satuan_barang_mid` (`id_barang`, `nama_satuan`, `dt_qty`, `sn`) VALUES
('AFK001', 'Pack', 20, NULL),
('AFK002', 'Pack', 20, '@AFK002100'),
('LK012', 'Pack', 10, '@LK01210'),
('LK012', 'Pack', 10, '@LK01230');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` text NOT NULL,
  `alamat` text NOT NULL,
  `email` text NOT NULL,
  `telpon` text NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `nama_perusahaan`, `alamat`, `email`, `telpon`, `status`) VALUES
(1, 'Indieshu', 'Jalan Veteran', 'gigibaja@gmail.com', '0123-01223', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(45) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `asal_daerah` varchar(45) DEFAULT NULL,
  `kontak_supplier` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `asal_daerah`, `kontak_supplier`) VALUES
('POX99213', 'PT Anggasara', 'Sumber', 'Cirebon', '988312'),
('RX-001', 'PT Singa Jaya', 'Kedawung', 'Cirebon', '099211');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_menu`
--

CREATE TABLE `s_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_nama` varchar(255) DEFAULT NULL,
  `menu_index` int(11) DEFAULT NULL,
  `menu_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 Mainmenu, 1 Submenu',
  `menu_parent` varchar(255) DEFAULT NULL,
  `menu_idelement` varchar(255) DEFAULT NULL,
  `menu_alias` varchar(255) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `s_menu`
--

INSERT INTO `s_menu` (`menu_id`, `menu_nama`, `menu_index`, `menu_type`, `menu_parent`, `menu_idelement`, `menu_alias`, `menu_link`, `menu_icon`) VALUES
(1, 'Master Data', 1, 0, '\r\n                                                echo ''\r\n                                                <li class="nav-item start ''.$status2.''">\r\n                                                    <a href="''.base_url($row2->menu_link).''" class="nav-lin', 'master-data', 'Master-Data', '#', 'icon-folder-alt'),
(2, 'Master Cabang', 1, 1, '1', 'master-cabang', 'Master-Cabang', 'Master-Data/Cabang', NULL),
(3, 'Master Jenis Gudang', 6, 1, '1', 'master-jenis-gudang', 'Master-Jenis-Gudang', 'Master-Data/Jenis-Gudang', NULL),
(4, 'Master Tipe Karyawan', 3, 1, '1', 'master-tipe-karyawan', 'Master-Tipe-Karyawan', 'Master-Data/Tipe-Karyawan', NULL),
(5, 'Master Karyawan', 4, 1, '1', 'master-karyawan', 'Master-Karyawan', 'Master-Data/Karyawan', NULL),
(6, 'Master Partner', 5, 1, '1', 'master-partner', 'Master-Partner', 'Master-Data/Partner', NULL),
(7, 'Master Gudang', 7, 1, '1', 'master-gudang', 'Master-Gudang', 'Master-Data/Gudang', NULL),
(8, 'Master Category 1', 9, 1, '1', 'category-1', 'Category-1', 'Master-Data/Jenis-Barang', NULL),
(9, 'Master Barang', 11, 1, '1', 'master-barang', 'Master-Barang', 'Master-Data/Barang', NULL),
(10, 'Master Atribut Barang', 11, 1, '1', 'master-atribut-barang', 'Master-Atribut-Barang', 'Master-Data/Atribut-Barang', NULL),
(11, 'Master Sub Atribut Barang', 12, 1, '1', 'master-sub-atribut-barang', 'Master-Sub-Atribut-Barang', 'Master-Data/Sub-Atribut-Barang', NULL),
(12, 'Produksi', 3, 0, '', 'produksi', 'Produksi', '#', 'icon-folder-alt'),
(13, 'Bukti Keluar Barang', 1, 1, '12', 'bukti-keluar-barang', 'Produksi/Bukti-Keluar-Barang', 'Produksi/Bukti-Keluar-Barang', NULL),
(14, 'Master Satuan', 8, 1, '1', 'master-satuan', 'Master-Satuan', 'Master-Data/Satuan', NULL),
(15, 'Master Departemen', 2, 1, '1', 'master-departemen', 'Master-Data/Departemen', 'Master-Data/Departemen', NULL),
(16, 'Inventory', 1, 1, '27', 'inventory', 'Inventory', 'Inventory', 'icon-folder-alt'),
(17, 'Stok Gudang', 1, 1, '18', 'stok-gudang', 'Inventory/Stok-Gudang', 'Inventory/Stok-Gudang', NULL),
(18, 'Gudang', 4, 0, '', 'gudang', 'Gudang', 'Gudang', 'icon-folder-alt'),
(19, 'Bukti Keluar Barang', 1, 1, '18', 'bukti-keluar-barang', 'Gudang/Bukti-Keluar-Barang', 'Gudang/Bukti-Keluar-Barang', NULL),
(20, 'Permintaan Pembelian Barang', 3, 1, '18', 'surat-permintaan-pembelian', 'Gudang/Surat-Permintaan-Pembelian', 'Gudang/Surat-Permintaan-Pembelian', NULL),
(21, 'Pembelian', 5, 0, '', 'pembelian', 'Pembelian', 'Pembelian', 'icon-folder-alt'),
(22, 'Permintaan Pembelian Barang', 2, 1, '21', 'surat-permintaan-pembelian', 'Pembelian/Surat-Permintaan-Pembelian', 'Pembelian/Surat-Permintaan-Pembelian', NULL),
(23, 'Penawaran Harga', 2, 1, '21', 'penawaran-harga', 'Pembelian/Penawaran-Harga', 'Pembelian/Penawaran-Harga', NULL),
(24, 'Laporan', 8, 0, NULL, 'laporan', 'Laporan', 'Laporan', 'icon-folder-alt'),
(25, 'Laporan Harian Keluar Barang', 1, 1, '24', 'laporan-harian-keluar-barang', 'Laporan/Laporan-Harian-Keluar-Barang', 'Laporan/Laporan-Harian-Keluar-Barang', NULL),
(26, 'Setting', 9, 0, NULL, 'setting', 'Setting', 'Setting', 'icon-folder-alt'),
(27, 'User Privilege', 1, 1, '26', 'setting/user-privilege', 'Setting/User-Privilege', 'Setting/User-Privilege', NULL),
(28, 'Purchase Order', 3, 1, '21', 'purchase-order', 'Pembelian/Purchase-Order', 'Pembelian/Purchase-Order', NULL),
(29, 'Persetujuan', 7, 0, NULL, 'persetujuan', 'Persetujuan', 'Persetujuan', 'icon-folder-alt'),
(30, 'Purchase Order', 1, 1, '29', 'purchase-order', 'Persetujuan/Purchase-Order', 'Persetujuan/Purchase-Order', NULL),
(31, 'Penerimaan Barang', 4, 1, '18', 'penerimaan-barang', 'Gudang/Penerimaan-Barang', 'Gudang/Penerimaan-Barang', NULL),
(32, 'Penerimaan Barang', 4, 1, '21', 'penerimaan-barang', 'Pembelian/Penerimaan-Barang', 'Pembelian/Penerimaan-Barang', NULL),
(33, 'Retur Pembelian', 5, 1, '18', 'retur-pembelian', 'Gudang/Retur-Pembelian', 'Gudang/Retur-Pembelian', NULL),
(34, 'Permintaan Jasa', 2, 1, '12', 'permintaan-jasa', 'Produksi/Permintaan-Jasa', 'Produksi/Permintaan-Jasa', NULL),
(35, 'Permintaan Jasa', 6, 1, '18', 'permintaan-jasa', 'Gudang/Permintaan-Jasa', 'Gudang/Permintaan-Jasa', NULL),
(36, 'Retur Pembelian', 5, 1, '21', 'retur-pembelian', 'Pembelian/Retur-Pembelian', 'Pembelian/Retur-Pembelian', NULL),
(37, 'Nota Debet', 6, 1, '21', 'nota-debet', 'Pembelian/Nota-Debet', 'Pembelian/Nota-Debet', NULL),
(38, 'Work Order', 7, 1, '21', 'work-order', 'Pembelian/Work-Order', 'Pembelian/Work-Order', NULL),
(39, 'Nota Debet', 2, 1, '29', 'nota-debet', 'Persetujuan/Nota-Debet', 'Persetujuan/Nota-Debet', NULL),
(40, 'Work Order', 3, 1, '29', 'work-order', 'Persetujuan/Work-Order', 'Persetujuan/Work-Order', NULL),
(41, 'Surat Jalan', 7, 1, '18', 'surat-jalan', 'Gudang/Surat-Jalan', 'Gudang/Surat-Jalan', NULL),
(42, 'Penjualan', 6, 0, '', 'penjualan', 'Penjualan', 'Penjualan', 'icon-folder-alt'),
(43, 'Estimasi Penjualan', 1, 1, '42', 'estimasi-penjualan', 'Penjualan/Estimasi-Penjualan', 'Penjualan/Estimasi-Penjualan', NULL),
(44, 'Estimasi Penjualan', 4, 1, '29', 'estimasi-penjualan', 'Persetujuan/Estimasi-Penjualan', 'Persetujuan/Estimasi-Penjualan', NULL),
(45, 'Jadwal Produksi', 3, 1, '12', 'jadwal-produksi', 'Produksi/Jadwal-Produksi', 'Produksi/Jadwal-Produksi', NULL),
(46, 'Perhitungan Kebutuhan Bahan', 4, 1, '12', 'perhitungan-kebutuhan-barang', 'Produksi/Perhitungan-Kebutuhan-Bahan', 'Produksi/Perhitungan-Kebutuhan-Bahan', NULL),
(47, 'Perhitungan Kebutuhan Bahan', 8, 1, '18', 'perhitungan-kebutuhan-barang', 'Gudang/Perhitungan-Kebutuhan-Bahan', 'Gudang/Perhitungan-Kebutuhan-Bahan', NULL),
(48, 'Ketidaksesuaian Spesifikasi', 5, 1, '12', 'ketidaksesuaian-spesifikasi', 'Produksi/Ketidaksesuaian-Spesifikasi', 'Produksi/Ketidaksesuaian-Spesifikasi', NULL),
(49, 'Perolehan Produksi', 6, 1, '12', 'perolehan-produksi', 'Produksi/Perolehan-Produksi', 'Produksi/Perolehan-Produksi', NULL),
(50, 'Accounting', 7, 0, NULL, 'accounting', 'Accounting', 'Accounting', 'icon-folder-alt'),
(51, 'Pengubahan Bahan', 7, 1, '12', 'pengubahan-bahan', 'Produksi/Pengubahan-Bahan', 'Produksi/Pengubahan-Bahan', NULL),
(52, 'Pengubahan Bahan', 1, 1, '50', 'pengubahan-bahan', 'Accounting/Pengubahan-Bahan', 'Accounting/Pengubahan-Bahan', NULL),
(53, 'Serah Terima', 8, 1, '12', 'serah-terima', 'Produksi/Serah-Terima', 'Produksi/Serah-Terima', NULL),
(54, 'Serah Terima', 9, 1, '18', 'serah-terima', 'Gudang/Serah-Terima', 'Gudang/Serah-Terima', NULL),
(55, 'Pengembalian Barang', 9, 1, '12', 'pengembalian-barang', 'Produksi/Pengembalian-Barang', 'Produksi/Pengembalian-Barang', NULL),
(56, 'Pengembalian Barang', 12, 1, '18', 'pengembalian-barang', 'Gudang/Pengembalian-Barang', 'Gudang/Pengembalian-Barang', NULL),
(57, 'Master Mata Uang', 13, 1, '1', 'master-mata-uang', 'Master-Data/Mata-Uang', 'Master-Data/Mata-Uang', NULL),
(58, 'Master Jenis Produksi', 14, 1, '1', 'master-jenis-produksi', 'Master-Data/Jenis-Produksi', 'Master-Data/Jenis-Produksi', NULL),
(59, 'Jadwal Produksi', 5, 1, '29', 'jadwal-produksi', 'Persetujuan/Jadwal-Produksi', 'Persetujuan/Jadwal-Produksi', NULL),
(60, 'Marketing', 8, 1, '26', 'marketing', 'Marketing', 'Marketing', 'icon-folder-alt'),
(61, 'Purchase Order Customer', 9, 1, '42', 'purchase-order-customer', 'Marketing/Purchase-Order-Customer', 'Marketing/Purchase-Order-Customer', NULL),
(62, 'Laporan SPP Belum Realisasi', 2, 1, '24', 'laporan-spp-belum-realisasi', 'Laporan/SPP-Belum-Realisasi', 'Laporan/SPP-Belum-Realisasi', NULL),
(63, 'Purchase Order Customer', 6, 1, '29', 'purchase-order-customer', 'Persetujuan/Purchase-Order-Customer', 'Persetujuan/Purchase-Order-Customer', NULL),
(64, 'Sales Order', 2, 1, '42', 'sales-order-customer', 'Penjualan/Sales-Order-Customer', 'Penjualan/Sales-Order-Customer', NULL),
(65, 'Sales Order', 7, 1, '29', 'sales-order-customer', 'Persetujuan/Sales-Order-Customer', 'Persetujuan/Sales-Order-Customer', NULL),
(66, 'Surat Jalan', 3, 1, '42', 'surat-jalan', 'Penjualan/Surat-Jalan', 'Penjualan/Surat-Jalan', NULL),
(67, 'Faktur Penjualan', 4, 1, '42', 'faktur-penjualan', 'Penjualan/Faktur-Penjualan', 'Penjualan/Faktur-Penjualan', NULL),
(68, 'Surat Jalan Retur', 5, 1, '42', 'surat-jalan-retur', 'Penjualan/Surat-Jalan-Retur', 'Penjualan/Surat-Jalan-Retur', NULL),
(69, 'Nota Kredit', 6, 1, '42', 'nota-kredit', 'Penjualan/Nota-Kredit', 'Penjualan/Nota-Kredit', NULL),
(70, 'Perhitungan Kebutuhan Bahan', 6, 1, '29', 'perhitungan-kebutuhan-bahan', 'Persetujuan/Perhitungan-Kebutuhan-Bahan', 'Persetujuan/Perhitungan-Kebutuhan-Bahan', NULL),
(71, 'Pengubahan Bahan', 7, 1, '29', 'pengubahan-bahan', 'Persetujuan/Pengubahan-Bahan', 'Persetujuan/Pengubahan-Bahan', NULL),
(72, 'Klaim/Retur Penjualan', 10, 1, '42', 'klaim-retur-penjualan', 'Marketing/Klaim-Retur-Penjualan', 'Marketing/Klaim-Retur-Penjualan', NULL),
(73, 'Klaim/Retur Penjualan', 11, 1, '42', 'klaim-retur-penjualan', 'Penjualan/Klaim-Retur-Penjualan', 'Penjualan/Klaim-Retur-Penjualan', NULL),
(74, 'Klaim/Retur Penjualan', 8, 1, '29', 'klaim-retur-penjualan', 'Persetujuan/Klaim-Retur-Penjualan', 'Persetujuan/Klaim-Retur-Penjualan', NULL),
(75, 'Penerimaan Barang Retur', 11, 1, '18', 'penerimaan-barang-retur', 'Gudang/Penerimaan-Barang-Retur', 'Gudang/Penerimaan-Barang-Retur', NULL),
(76, 'Point of Sale', 8, 1, '42', 'point-of-sale', 'Point-of-Sale', 'Penjualan/Pos', NULL),
(77, 'Master Brand', 15, 1, '1', 'master-brand', 'Master-Brand', 'Master-Data/Master-Brand', NULL),
(78, 'Master Category 2', 10, 1, '1', 'category-2', 'Category-2', 'Master-Data/Master-Kategori', NULL),
(79, 'Master Promo', 16, 1, '1', 'master-promo', 'Master-Promo', 'Master-Data/Master-Promo', NULL),
(80, 'Master Konsinyasi', 17, 1, '1', 'konsinyasi', 'Konsinyasi', 'Master-Data/Konsinyasi', NULL),
(81, 'User Account', 1, 1, '26', 'setting/user-account', 'User Account', 'Setting/User-Account', NULL),
(82, 'Mutasi Barang', 7, 1, '18', 'Master-Data/gudang/mutasi-barang', 'Master-Data/Gudang/Mutasi-Barang', 'Master-Data/Gudang/Mutasi-Barang', NULL),
(83, 'Master EDC', 13, 1, '1', 'master-edc', 'Master-Data/Master-EDC', 'Master-Data/EDC', NULL),
(84, 'Input Pengunjung', 12, 2, '42', NULL, NULL, NULL, NULL),
(85, 'Laporan Penerimaan Barang', 3, 1, '24', 'penerimaan-barang', 'Laporan/penerimaan-barang', 'Laporan/penerimaan-barang', NULL),
(86, 'Laporan POS', 4, 1, '24', 'penjualan', 'Laporan/penjualan', 'Laporan/penjualan', NULL),
(87, 'Master Bank', 18, 1, '1', 'master-bank', 'Master-Bank', 'Master-Data/Bank', NULL),
(88, 'Master Jenis Kartu Kredit', 19, 1, '1', 'master-kartukredit', 'Master-KartuKredit', 'Master-Data/Master-KartuKredit', NULL),
(89, 'Laporan Konsinyasi', 5, 1, '24', 'konsinyasi', 'Laporan/konsinyasi', 'Laporan/konsinyasi', NULL),
(90, 'Pelunasan Hutang', 8, 1, '21', 'pelunasan-hutang', 'Pembelian/Pelunasan-Hutang', 'Pembelian/Pelunasan-Hutang', NULL),
(91, 'Stok Opname', 1, 1, '18', 'stok-opname', 'Inventory/stok-opname', 'Inventory/stok-opname', NULL),
(92, 'Pelunasan Piutang', 1, 1, '42', 'pelunasan-piutang', 'Penjualan/Pelunasan-Piutang', 'Penjualan/Pelunasan-Piutang', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `track`
--

CREATE TABLE `track` (
  `kode_track` int(11) NOT NULL,
  `kode_customer` varchar(45) NOT NULL,
  `kode_salesman` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `track`
--

INSERT INTO `track` (`kode_track`, `kode_customer`, `kode_salesman`) VALUES
(1, 'CS-00001', 'SLS-00001'),
(3, 'CS-00002', 'SLS-00003'),
(6, 'CS-00003', 'SLS-00002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `password` text,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `otoritas` varchar(45) DEFAULT NULL,
  `kontak` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `name`, `email`, `otoritas`, `kontak`, `foto`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Darmawan', 'smenjensen@gmail.com', 'Master', '09123141', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tracker`
--

-- --------------------------------------------------------

--
-- Struktur untuk view `barang`
--
DROP TABLE IF EXISTS `barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `barang`  AS  select `a`.`kode_barang` AS `kode_barang`,`a`.`nama_barang` AS `nama_barang`,`d`.`harga_beli` AS `harga_beli`,`d`.`harga_retail` AS `harga_retail`,`a`.`qty_ctrl` AS `qty_ctrl`,`a`.`sn` AS `sn`,sum(if((`a`.`sn` = 'Null'),((`a`.`qty` * `b`.`dt_qty`) * `c`.`dt_qty`),(((`a`.`qty` * `a`.`qty_ctrl`) * `b`.`dt_qty`) * `c`.`dt_qty`))) AS `stok_awal`,`c`.`nama_satuan` AS `nama_satuan`,`f`.`nama_gudang` AS `nama_gudang` from (((((`penerimaan_barang_dt` `a` join `satuan_barang_mid` `b`) join `satuan_barang_low` `c`) join `harga` `d`) join `penerimaan_barang` `e`) join `gudang` `f`) where ((`a`.`kode_barang` = convert(`b`.`id_barang` using utf8)) and (`a`.`kode_barang` = convert(`c`.`id_barang` using utf8)) and (`a`.`kode_barang` = convert(`d`.`id_barang` using utf8)) and (`a`.`kode_bpb` = `e`.`kode_bpb`) and (`e`.`kode_gudang` = `f`.`kode_gudang`)) group by `a`.`sn`,`f`.`kode_gudang` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tracker`
--
DROP TABLE IF EXISTS `v_tracker`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tracker`  AS  select `a`.`kode_track` AS `kode_track`,`c`.`kode_sales` AS `kode_sales`,`c`.`nama_sales` AS `nama_sales`,`b`.`id_customer` AS `id_customer`,`b`.`nama` AS `nama`,`b`.`alamat` AS `alamat`,`b`.`asal_daerah` AS `asal_daerah` from ((`track` `a` join `customer` `b`) join `salesman` `c`) where ((`a`.`kode_customer` = `b`.`id_customer`) and (`a`.`kode_salesman` = `c`.`kode_sales`) and (`b`.`status` = 'Aktif')) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barcode`
--
ALTER TABLE `barcode`
  ADD PRIMARY KEY (`nilai`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id_coupon`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `diskon_barang`
--
ALTER TABLE `diskon_barang`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `diskon_coupon`
--
ALTER TABLE `diskon_coupon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `diskon_p`
--
ALTER TABLE `diskon_p`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `diskon_pembelian`
--
ALTER TABLE `diskon_pembelian`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `dt_pembelian`
--
ALTER TABLE `dt_pembelian`
  ADD KEY `fk_dt_pembelian_pembelian_idx` (`id_pembelian`);

--
-- Indexes for table `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  ADD KEY `fk_dt_penjualan_barang1_idx` (`id_barang`),
  ADD KEY `fk_dt_penjualan_penjualan1_idx` (`id_penjualan`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `karyawan_type`
--
ALTER TABLE `karyawan_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `m_cabang`
--
ALTER TABLE `m_cabang`
  ADD PRIMARY KEY (`cabang_kode`);

--
-- Indexes for table `m_category_2`
--
ALTER TABLE `m_category_2`
  ADD PRIMARY KEY (`category_2_id`);

--
-- Indexes for table `m_jenis_barang`
--
ALTER TABLE `m_jenis_barang`
  ADD PRIMARY KEY (`jenis_barang_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `fk_pembelian_supplier1_idx` (`id_supplier`);

--
-- Indexes for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD PRIMARY KEY (`kode_bpb`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `fk_penjualan_costumer1_idx` (`id_customer`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`kode_sales`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`nama_satuan`);

--
-- Indexes for table `satuan_barang_low`
--
ALTER TABLE `satuan_barang_low`
  ADD KEY `fk_satuan_barang_low_satuan_idx` (`nama_satuan`);

--
-- Indexes for table `satuan_barang_mid`
--
ALTER TABLE `satuan_barang_mid`
  ADD KEY `fk_satuan_barang_mid_satuan_idx` (`nama_satuan`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `s_menu`
--
ALTER TABLE `s_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`kode_track`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diskon_barang`
--
ALTER TABLE `diskon_barang`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `diskon_coupon`
--
ALTER TABLE `diskon_coupon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `diskon_pembelian`
--
ALTER TABLE `diskon_pembelian`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_category_2`
--
ALTER TABLE `m_category_2`
  MODIFY `category_2_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `m_jenis_barang`
--
ALTER TABLE `m_jenis_barang`
  MODIFY `jenis_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `kode_track` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dt_pembelian`
--
ALTER TABLE `dt_pembelian`
  ADD CONSTRAINT `fk_dt_pembelian_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_pembelian_supplier1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `satuan_barang_low`
--
ALTER TABLE `satuan_barang_low`
  ADD CONSTRAINT `fk_satuan_barang_low_satuan` FOREIGN KEY (`nama_satuan`) REFERENCES `satuan` (`nama_satuan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `satuan_barang_mid`
--
ALTER TABLE `satuan_barang_mid`
  ADD CONSTRAINT `fk_satuan_barang_mid_satuan` FOREIGN KEY (`nama_satuan`) REFERENCES `satuan` (`nama_satuan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

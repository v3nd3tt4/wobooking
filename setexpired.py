from orator import DatabaseManager

config = {
    'mysql': {
        'driver': 'mysql',
        'host': 'localhost',
        'database': 'db_wo',
        'user': 'root',
        'password': 'goldroger27',
        'prefix': ''
    }
}

db = DatabaseManager(config)
results = db.select('SELECT * from tb_pesan_gedung where (DATE_ADD(NOW(), INTERVAL 2 HOUR) > waktu_pesan) and status = "pending"')


# print results
for r in results:
	db.table('tb_pesan_gedung').where('id_pesan', r['id_pesan']).update(status='expired')

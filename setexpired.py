from orator import DatabaseManager

config = {
    'mysql': {
        'driver': 'mysql',
        'host': 'localhost',
        'database': 'db_wo',
        'user': 'root',
        'password': 'lupalagi',
        'prefix': ''
    }
}

db = DatabaseManager(config)
results = db.select('SELECT * from tb_pesan_gedung where (now() > DATE_ADD(waktu_pesan, INTERVAL 2 HOUR)) and status = "pending" and status_pembayaran = "Belum Melakukan Pembayaran"')


# print results
for r in results:
	# print r
	db.table('tb_pesan_gedung').where('id_pesan', r['id_pesan']).update(status='expired')

# query
# SELECT 
# waktu_pesan, 
# now() as sekarang, 
# DATE_ADD(waktu_pesan, INTERVAL 2 HOUR) as expired, 
# if(now() > (DATE_ADD(waktu_pesan, INTERVAL 2 HOUR)), 'lebih','kurang') as jam_setelah 
# from tb_pesan_gedung 
# where 
# (DATE_ADD(NOW(), INTERVAL 2 HOUR) > waktu_pesan) 
# and
# status = 'pending'

#install orator
#cara nya: pip install orator

#install pymysql
#cara nya: pip install pymysql

#cara run crontab linux
#ini koding nya => @hourly /usr/bin/python /var/www/html/wobooking/setexpired.py

#1. crontab -e
#2. @hourly /usr/bin/python /var/www/html/wobooking/setexpired.py
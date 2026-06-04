import aiomysql

DB_CONFIG = {
    'host': 'localhost',
    'port': 3306,
    'user': 'boardy',
    'password': '1234',
    'db': 'boardy',
    'charset': 'utf8mb4'
}

async def get_db():
    return await aiomysql.connect(**DB_CONFIG)

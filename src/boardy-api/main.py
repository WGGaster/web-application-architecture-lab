from fastapi import FastAPI
from datetime import datetime
from fastapi.middleware.cors import CORSMiddleware
from routers import comments
from database import get_db
import aiomysql, time, asyncio

origins = [
    "http://khalitov.ai-info.ru",
    "https://khalitov.ai-info.ru",
    "http://localhost",
    "http://localhost:8000",
]

app = FastAPI(title='Boardy API',  version='0.2.0')
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["GET", "POST", "PUT", "DELETE", "OPTIONS"],
    allow_headers=["*"],
)

app.include_router(comments.router, prefix='/api')


@app.get('/status')
async def status():
    return {
	'status' : 'ok',
        'service' : 'boardy-api',
        'time' : str(datetime.now())
    }

@app.get('/messages')
async def get_messages():
    conn = await get_db()
    async with conn.cursor(aiomysql.DictCursor) as cur:
        await cur.execute(
            'SELECT posts.body AS message, users.name, '
            'posts.created_at FROM posts '
            'JOIN users ON posts.author_id = users.id '
            'ORDER BY posts.created_at DESC'
        )
        messages = await cur.fetchall()
    conn.close()
    for m in messages:
        m['created_at'] = str(m['created_at'])
    return {'messages': messages, 'count': len(messages)}

@app.get('/users')
async def get_users():
    conn = await get_db()
    async with conn.cursor(aiomysql.DictCursor) as cur:
        await cur.execute(
            'SELECT id, name, email, created_at FROM users'
        )
        users = await cur.fetchall()
    conn.close()
    for u in users:
        u['created_at'] = str(u['created_at'])
    return {'users': users, 'count': len(users)}

# --- Демонстрация async ---

@app.get('/api/slow')
async def slow_query():
    """Имитация запроса к БД: 2 сек (async — не блокирует)"""
    await asyncio.sleep(2)
    return {'result': 'done', 'time': str(datetime.now())}


@app.get('/api/slow-blocking')
async def slow_blocking():
    """ПЛОХО: time.sleep блокирует весь event loop!"""
    time.sleep(2)
    return {'result': 'done', 'time': str(datetime.now())}

@app.get('/api/counter')
async def counter():
    """Процесс живёт — состояние между запросами"""
    if not hasattr(app.state, 'counter'):
        app.state.counter = 0
    app.state.counter += 1
    return {'counter': app.state.counter}

from database import get_db
from pydantic import BaseModel
import aiomysql
import fastapi
router = fastapi.APIRouter()

class CommentCreate(BaseModel):
    body: str

class CommentUpdate(BaseModel):
    body: str

@router.get("/posts/{post_id}/comments")
async def get_comments(post_id: int):
    conn = await get_db()
    async with conn.cursor(aiomysql.DictCursor) as cur:
        await cur.execute(
            'select c.id, c.body, c.created_at, '
            'u.name as author_name '
            'from comments c '
            'join users u on c.author_id = u.id '
            'where c.post_id = %s '
            'order by c.created_at',
            (post_id,)
        )
        items = await cur.fetchall()
    conn.close()

    for item in items:
        item['created_at'] = str(item['created_at'])
    return {'items': items, 'count': len(items)}

@router.post("/posts/{post_id}/comments", status_code=201)
async def create_comment(post_id: int, data: CommentCreate):
    if not data.body.strip():
        raise fastapi.HTTPException(status_code=422, detail='Текст пустой')
    conn = await get_db()
    async with conn.cursor() as cur:
        await cur.execute('select id from posts where id = %s', (post_id,))
        if not await cur.fetchone():
            conn.close()
            raise fastapi.HTTPException(status_code=404, detail="Пост не найден")
        await cur.execute(
            'insert into comments (body, post_id, author_id) values (%s, %s, %s)',
            (data.body, post_id, 2) # ← author_id=1 хардкод (TODO: JWT)
        )
        await conn.commit()
        new_id = cur.lastrowid
    conn.close()
    return {'id': new_id, 'body': data.body, 'status': 'created'}

@router.put('/comments/{comment_id}')
async def update_comment(comment_id: int, data: CommentUpdate):
    if not data.body.strip():
        raise fastapi.HTTPException(status_code=422, detail='Текст пустой')
    conn = await get_db()
    async with conn.cursor() as cur:
        await cur.execute(
            'update comments set body = %s where id = %s',
            (data.body, comment_id)
        )
        if cur.rowcount == 0:
            conn.close()
            raise fastapi.HTTPException(status_code=404, detail='Не найден комментарий')
        await conn.commit()
    conn.close()
    return {'id': comment_id, 'body': data.body, 'status': 'updated'}

@router.delete('/comments/{comment_id}', status_code=204)
async def delete_comment(comment_id: int):
    conn = await get_db()
    async with conn.cursor() as cur:
        await cur.execute(
            'delete from comments where id = %s ',
            (comment_id,)
        )
        if cur.rowcount == 0:
            conn.close()
            raise fastapi.HTTPException(status_code=404, detail='Не найден комментарий')
        await conn.commit()
    conn.close()
    return {'id': comment_id, 'status': 'Удалён'}














# stolencars_bot
Реєстр викрадених автомобілів диверсантами. Телеграм бот

## Як користуватися ботом:

Відправте боту номер підозрілого авто для пошуку його в базі викрадених диверсантами автомобілів. 
Приклад повідомлення: !AA1234AA
Повідомлення повинно починатися з ! (знак оклику). Для пошуку можна водити частину номера.

## Як додавати нові дані в бота:

/add номер_авто,марка_авто,коментар
Після команди /add обов'язково ставим відступ, кома розділювач данних, якщо її не використати то все запишеться в номер авто. Після коми не робимо відступів. В тексті не використовуємо коми, вони розділяють дані щоб бот розумів що і куди записувати. 

## Видалення даних. 
Для адмінів коли виводяться дані, відображається ID запису.
/delete id_запису

Якщо помилково видалив дані
/restore id_запису

Щоб зробити користувача адміном потрібно в БД таблиця "users", змінити status на 1


Приклад готово бота: https://t.me/stolencarsbot

Слава Україні!
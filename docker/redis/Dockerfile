FROM andreyst/debian-base
MAINTAINER Andrey Stolbovsky <andrey.stolbovsky@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN groupadd -r redis && useradd -r -g redis redis

ENV REDIS_VERSION 2.8.17
ENV REDIS_DOWNLOAD_URL http://download.redis.io/releases/redis-2.8.17.tar.gz
ENV REDIS_DOWNLOAD_SHA1 913479f9d2a283bfaadd1444e17e7bab560e5d1e

# for redis-sentinel see: http://redis.io/topics/sentinel
RUN buildDeps='gcc libc6-dev make'; \
  set -x \
  && apt-get update && apt-get install -y $buildDeps --no-install-recommends \
  && rm -rf /var/lib/apt/lists/* \
  && mkdir -p /usr/src/redis \
  && curl -sSL "$REDIS_DOWNLOAD_URL" -o redis.tar.gz \
  && echo "$REDIS_DOWNLOAD_SHA1 *redis.tar.gz" | sha1sum -c - \
  && tar -xzf redis.tar.gz -C /usr/src/redis --strip-components=1 \
  && rm redis.tar.gz \
  && make -C /usr/src/redis \
  && make -C /usr/src/redis install \
  && ln -s redis-server "$(dirname "$(which redis-server)")/redis-sentinel" \
  && rm -r /usr/src/redis \
  && apt-get purge -y --auto-remove $buildDeps \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

RUN mkdir /data && chown redis:redis /data
VOLUME /data
VOLUME ["/var/log"]

COPY conf/redis.conf /usr/local/etc/redis/redis.conf

EXPOSE 6379

COPY docker-entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

WORKDIR /data

CMD [ "redis-server" ]

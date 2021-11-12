import 'dart:async';

import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_bloc.dart';

import 'package:mobileapplication/screens/entercode/entercode_screen.dart';
import 'package:mobileapplication/screens/roomques/roomques_screen.dart';

import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc.dart';
import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc_observer.dart';

import 'package:mobileapplication/responsitory/repository.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_bloc.dart';

void main() {
  Bloc.observer = GetRoomBlocObserver();
  final Repository repository = Repository(http.Client());
  final StreamSocket streamSocket = StreamSocket();
  final SocketRepository socket = SocketRepository(streamSocket: streamSocket);
  final String iduser = DateTime.now().microsecondsSinceEpoch.toString();

  runApp(
    MultiBlocProvider(
      providers: [
        BlocProvider<EnterCodeBloc>(
          create: (context) => EnterCodeBloc(
            repository: repository,
          ),
        ),
        BlocProvider<GetRoomBloc>(
          create: (context) => GetRoomBloc(repository),
        ),
        BlocProvider<WaitRoomBloc>(
          create: (context) => WaitRoomBloc(streamSocket, socket),
        ),
      ],
      child: MyApp(
        repository: repository,
        iduser: iduser,
      ),
    ),
  );
}

class MyApp extends StatelessWidget {
  final Repository repository;
  final String iduser;

  const MyApp({
    Key? key,
    required this.repository,
    required this.iduser,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    print('Main' + iduser);
    return MaterialApp(
      title: 'Material app',
      home: BlocProvider(
        create: (context) => GetRoomBloc(repository),
        child: EnterCodeScreen(
          iduser: iduser,
        ),
      ),
    );
  }
}
